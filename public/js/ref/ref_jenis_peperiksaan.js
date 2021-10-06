$(function () {

    /* Init Datatable */
    var table = $('#table-' + jenis_peperiksaan.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: jenis_peperiksaan.route.datatable_url},
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
                return full.kod_peperiksaan;
            }
        },{
            "aTargets": [ 1 ],
            "width": "30%",
            "mRender": function ( value, type, full )  {
                return full.keterangan;
            }
        },{
            "aTargets": [ 2 ],
            "width": "30%",
            "mRender": function ( value, type, full )  {
                return full.keterangan_panjang;
            }
        },{
            "aTargets": [ 3 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+jenis_peperiksaan.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+jenis_peperiksaan.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+jenis_peperiksaan.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + jenis_peperiksaan.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + jenis_peperiksaan.table.name + '-label').html("Tambah "  + jenis_peperiksaan.table.name);
        $('#hidden_id_'+ jenis_peperiksaan.table.name).val("");
        $('#action_' + jenis_peperiksaan.table.name).val("add");
        $('#method_' + jenis_peperiksaan.table.name).val("");
        $('#btn-save-' + jenis_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $('.error_alert').hide();
        $(this).find("select,textarea, input").removeClass('is-invalid');
    });

    /* click edit */
    $('body').on('click', '#edit-' + jenis_peperiksaan.table.name, function () 
    {

        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();

        
        $.get(jenis_peperiksaan.route.action_url + id +'/edit', function (data) {

            $('#modal-' + jenis_peperiksaan.table.name + '-label').html("Kemaskini " + jenis_peperiksaan.table.name);
            $('#btn-save-' + jenis_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + jenis_peperiksaan.table.name).val(data.id);
            $('#action_' + jenis_peperiksaan.table.name).val("update");
            $('#method_' + jenis_peperiksaan.table.name).val("PUT");

            $('#kod_peperiksaan').val(data.kod_peperiksaan);
            $('#keterangan').val(data.keterangan);
            $('#keterangan_panjang').val(data.keterangan_panjang);

            $('#modal-' + jenis_peperiksaan.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + jenis_peperiksaan.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+jenis_peperiksaan.table.name+" dari pangkalan data!",
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
                    url: jenis_peperiksaan.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+jenis_peperiksaan.table.name+'_form').trigger("reset");
                        $('#table-'+jenis_peperiksaan.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ jenis_peperiksaan.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+jenis_peperiksaan.table.name+'_form', function(event){

        event.preventDefault();

        $('#btn-save-' + jenis_peperiksaan.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + jenis_peperiksaan.table.name).prop('disabled', true);

        var data = $('#'+jenis_peperiksaan.table.name+'_form').serialize();
        var action = $('#action_' + jenis_peperiksaan.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + jenis_peperiksaan.table.name).val();
            url = jenis_peperiksaan.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = jenis_peperiksaan.route.store_url;
            type = "POST";
            btn_text = "Simpan";
            
        }

        $.ajax({

            url: url,
            type: type,
            data: data,

        }).done(function(response) {

            if(response.errors){

                $.each(response.errors, function(index, error){
                    $('[name='+index+']').addClass("is-invalid");
                    $('.c_'+index).html(error);
                })

                $('#btn-save-' + jenis_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + jenis_peperiksaan.table.name).prop('disabled', false);

            } else {

                $('#'+jenis_peperiksaan.table.name+'_form').trigger("reset");
                $('#modal-' + jenis_peperiksaan.table.name).modal('hide');
                $('#modal' + jenis_peperiksaan.table.name + '-label').html("Tambah " + jenis_peperiksaan.table.name);
                $('#hidden_id_'+jenis_peperiksaan.table.name).val("");
                $('#action_'+jenis_peperiksaan.table.name).val("add");
                $('#method_'+jenis_peperiksaan.table.name).val("");
                $('#btn-save-'+jenis_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+jenis_peperiksaan.table.name).prop('disabled', false);
                $('#table-'+jenis_peperiksaan.table.name).DataTable().ajax.reload();

            }

        });
    });
});
