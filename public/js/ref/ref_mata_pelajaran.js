$(function () {

    /* Init Datatable */
    var table = $('#table-' + mata_pelajaran.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: mata_pelajaran.route.datatable_url},
        "bFilter": true,
        "language": {
            "paginate": {
                "previous": "Sebelumnya",
                "next": "Seterusnya",
            },
            "sSearch": "Carian",
            "sLengthMenu": "Paparan _MENU_ rekod",
            "lengthMenu": "Paparan _MENU_ rekod setiap laman",
            "zeroRecords": "Tiada rekod ditemui",
            "info": "Paparan laman _PAGE_ dari _PAGES_ daripada _TOTAL_ rekod",
            "infoEmpty": "",
            "infoFiltered": "(diisih dari _MAX_ keseluruhan rekod)"
        },
        "aoColumnDefs":[{
            "aTargets": [ 0 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.kod_mata_pelajaran
            }
        },{
            "aTargets": [ 1 ],
            "width": "30%",
            "mRender": function ( value, type, full )  {
                return full.nama_mata_pelajaran
            }
        },{
            "aTargets": [ 2 ],
            "width": "30%",
            "mRender": function ( value, type, full )  {
                return moment(full.updated_at).format("Do MMMM  YYYY")
            }
        },{
            "aTargets": [ 3 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+mata_pelajaran.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+mata_pelajaran.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+mata_pelajaran.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + mata_pelajaran.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('.c-markah_maksimum_kertas').hide();
        $('.c-kertas_hurdle_opt').hide();
        $('.c-kertas_matriks_opt').hide();
        $('.c-gred_kertas_opt').hide();
        $('.c-penentuan_standard_opt').hide();
        $('.c-kegunaan_lpm').hide();
        $('.c-calon').hide();
        $('#modal-' + mata_pelajaran.table.name + '-label').html("Tambah "  + mata_pelajaran.table.name);
        $('#hidden_id_'+ mata_pelajaran.table.name).val("");
        $('#action_' + mata_pelajaran.table.name).val("add");
        $('#method_' + mata_pelajaran.table.name).val("");
        $('#btn-save-' + mata_pelajaran.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $(this).find("select,textarea, input").removeClass('is-invalid');
    });

    /* click edit */
    $('body').on('click', '#edit-' + mata_pelajaran.table.name, function ()
    {

        var id      = $(this).data('id');

        $.get(mata_pelajaran.route.action_url + id +'/edit', function (data) {

            $('#modal' + mata_pelajaran.table.name + '-label').html("Kemaskini " + mata_pelajaran.table.name);
            $('#btn-save-' + mata_pelajaran.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + mata_pelajaran.table.name).val(data.id);
            $('#action_' + mata_pelajaran.table.name).val("update");
            $('#method_' + mata_pelajaran.table.name).val("PUT");

            $('#input_kod_mata_pelajaran').val(data.kod_mata_pelajaran);
            $('#input_mata_pelajaran_keterangan').val(data.keterangan);

            $('#modal-' + mata_pelajaran.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + mata_pelajaran.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+mata_pelajaran.table.name+" dari pangkalan data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Ya, sila padam!",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: false

        }).then((result) => {

            if (result.isConfirmed)
            {
                $.ajax({
                    type: "DELETE",
                    url: mata_pelajaran.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+mata_pelajaran.table.name+'_form').trigger("reset");
                        $('#table-'+mata_pelajaran.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ mata_pelajaran.table.name +" telah dipadam dari pangkalan data", "success");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            } else {

                Swal.fire("Tidak", "Proses pemadaman tidak berlaku", "error");

            }
        });
    });

    /* click submit */
    $(document).on('submit', '#'+mata_pelajaran.table.name+'_form', function(event){

        event.preventDefault();

        $(this).find("select,textarea, input,checkbox,radio").removeClass('is-invalid');

        $('#btn-save-' + mata_pelajaran.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + mata_pelajaran.table.name).prop('disabled', true);
       
        var data = $('#'+mata_pelajaran.table.name+'_form').serializeArray();

        var calon = []

        $("input:checkbox[name=calon]:checked").each(function() {
            calon.push($(this).val());
        });

        data.push({ name: "calon", value: calon });

        var action = $('#action_' + mata_pelajaran.table.name).val();

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + mata_pelajaran.table.name).val();
            url = mata_pelajaran.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = mata_pelajaran.route.store_url;
            type = "POST";
            btn_text = "Simpan";

        }

        $.ajax({

            url: url,
            type: type,
            data: data,
            success: function(){
                $('#'+mata_pelajaran.table.name+'_form').trigger("reset");
                $('.c-markah_maksimum_kertas').hide();
                $('.c-kertas_hurdle_opt').hide();
                $('.c-kertas_matriks_opt').hide();
                $('.c-gred_kertas_opt').hide();
                $('.c-penentuan_standard_opt').hide();
                $('.c-kegunaan_lpm').hide();
                $('.c-calon').hide();
                $('#modal-' + mata_pelajaran.table.name).modal('hide');
                $('#modal' + mata_pelajaran.table.name + '-label').html("Tambah " + mata_pelajaran.table.name);
                $('#hidden_id_'+mata_pelajaran.table.name).val("");
                $('#action_'+mata_pelajaran.table.name).val("add");
                $('#method_'+mata_pelajaran.table.name).val("");
                $('#btn-save-'+mata_pelajaran.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+mata_pelajaran.table.name).prop('disabled', false);
                $('#table-'+mata_pelajaran.table.name).DataTable().ajax.reload();

            },

            error: function (data) {
                
                var errors = JSON.parse(data.responseText);
                $.each(errors.errors, function(index, error){
                    $('[name='+index+']').addClass("is-invalid").slideDown(1000);
                    $('.c-'+index).html(error).slideDown(1000);
                })

                window.setTimeout(function() { 
                    $('.fa-circle-o-notch').remove();
                    $('#btn-save-'+mata_pelajaran.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                    $('#btn-save-'+mata_pelajaran.table.name).removeAttr('disabled');
                }, 1000);
                 
            }
        })
    });
});
