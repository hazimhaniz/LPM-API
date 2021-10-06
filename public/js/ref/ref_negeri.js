$(function () {

    /* Init Datatable */
    var table = $('#table-' + negeri.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: negeri.route.datatable_url},
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
                return full.kod_negeri;
            }
        },{
            "aTargets": [ 1 ],
            "width": "30%",
            "mRender": function ( value, type, full )  {
                return full.keterangan;
            }
        },{
            "aTargets": [ 2 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+negeri.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+negeri.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+negeri.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + negeri.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + negeri.table.name + '-label').html("Tambah "  + negeri.table.name);
        $('#hidden_id_'+ negeri.table.name).val("");
        $('#action_' + negeri.table.name).val("add");
        $('#method_' + negeri.table.name).val("");
        $('#btn-save-' + negeri.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $(this).find("select,textarea, input").removeClass('is-invalid');
    });

    /* click edit */
    $('body').on('click', '#edit-' + negeri.table.name, function () 
    {

        var id      = $(this).data('id');
                
        $.get(negeri.route.action_url + id +'/edit', function (data) {

            $('#modal' + negeri.table.name + '-label').html("Kemaskini " + negeri.table.name);
            $('#btn-save-' + negeri.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + negeri.table.name).val(data.id);
            $('#action_' + negeri.table.name).val("update");
            $('#method_' + negeri.table.name).val("PUT");

            $('#input_kod_negeri').val(data.id);
            $('#input_keterangan_negeri').val(data.keterangan);

            $('#modal-' + negeri.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + negeri.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+negeri.table.name+" dari pangkalan data!",
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
                    url: negeri.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+negeri.table.name+'_form').trigger("reset");
                        $('#table-'+negeri.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ negeri.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+negeri.table.name+'_form', function(event){

        event.preventDefault();
        $(this).find("select,textarea, input").removeClass('is-invalid');
        $('#btn-save-' + negeri.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + negeri.table.name).prop('disabled', true);

        var data = $('#'+negeri.table.name+'_form').serialize();
        var action = $('#action_' + negeri.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + negeri.table.name).val();
            url = negeri.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = negeri.route.store_url;
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

                $('#btn-save-' + negeri.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + negeri.table.name).prop('disabled', false);

            } else {

                $('#'+negeri.table.name+'_form').trigger("reset");
                $('#modal-' + negeri.table.name).modal('hide');
                $('#modal' + negeri.table.name + '-label').html("Tambah " + negeri.table.name);
                $('#hidden_id_'+negeri.table.name).val("");
                $('#action_'+negeri.table.name).val("add");
                $('#method_'+negeri.table.name).val("");
                $('#btn-save-'+negeri.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+negeri.table.name).prop('disabled', false);
                $('#table-'+negeri.table.name).DataTable().ajax.reload();

            }

        });
    });
});
