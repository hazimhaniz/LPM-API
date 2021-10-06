$(function () {

    /* Init Datatable */
    var table = $('#table-' + pusat.table.name).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:  pusat.route.datatable_url
        },
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
        "bFilter": true,
        responsive: true,
        "aoColumnDefs":[{
            "aTargets": [ 0 ],
            "width": "10%",
            "mRender": function ( value, type, full )  {
                return full.kod_pusat
            }
        },{
            "aTargets": [ 1 ],
            "width": "40%",
            "mRender": function ( value, type, full )  {
                return full.nama_pusat
            }
        },{
            "aTargets": [ 2 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Edit" id="edit-pusat" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Delete" id="delete-pusat" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-pusat').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + pusat.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + pusat.table.name + '-label').html("Tambah "  + pusat.table.name);
        $('#hidden_id_'+ pusat.table.name).val("");
        $('#action_' + pusat.table.name).val("add");
        $('#method_' + pusat.table.name).val("");
        $('#btn-save-' + pusat.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $('.error_alert').hide();
    });

    /* click edit */
    $('body').on('click', '#edit-' + pusat.table.name, function ()
    {

        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();

        $.get(pusat.route.action_url + id +'/edit', function (data) {

            $('#modal' + pusat.table.name + '-label').html("Kemaskini " + pusat.table.name);
            $('#btn-save-' + pusat.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + pusat.table.name).val(data.id);
            $('#action_' + pusat.table.name).val("update");
            $('#method_' + pusat.table.name).val("PUT");

            $('#input_kod_pusat').val(data.kod_pusat);
            $('#input_nama_pusat').val(data.nama_pusat);

            $('#modal-' + pusat.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + pusat.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+pusat.table.name+" dari pangkalan data!",
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
                    url: pusat.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+pusat.table.name+'_form').trigger("reset");
                        $('#table-'+pusat.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ pusat.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+pusat.table.name+'_form', function(event){

        var errors = $('.error_alert');
        event.preventDefault();

        $('#btn-save-' + pusat.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + pusat.table.name).prop('disabled', true);

        var data = $('#'+pusat.table.name+'_form').serialize();
        var action = $('#action_' + pusat.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + pusat.table.name).val();
            url = pusat.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = pusat.route.store_url;
            type = "POST";
            btn_text = "Simpan";

        }

        $.ajax({

            url: url,
            type: type,
            data: data,

        }).done(function(response) {

            errors.hide().find('ul').empty();

            if(response.errors){

                $.each(response.errors, function(index, error){
                    errors.find('ul').append('<li><i class="fa fa-exclamation-circle mr-3"></i> '+error+'</li>');
                });

                $('#btn-save-' + pusat.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + pusat.table.name).prop('disabled', false);

                errors.slideDown();

            } else {

                $('#'+pusat.table.name+'_form').trigger("reset");
                $('#modal-' + pusat.table.name).modal('hide');
                $('#modal' + pusat.table.name + '-label').html("Tambah " + pusat.table.name);
                $('#hidden_id_'+pusat.table.name).val("");
                $('#action_'+pusat.table.name).val("add");
                $('#method_'+pusat.table.name).val("");
                $('#btn-save-'+pusat.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+pusat.table.name).prop('disabled', false);
                $('#table-'+pusat.table.name).DataTable().ajax.reload();

            }

        });
    });
});
