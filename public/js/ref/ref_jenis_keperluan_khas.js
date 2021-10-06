$(function () {

    /* Init Datatable */
    var table = $('#table-' + config.table.table_jenis_keperluan_khas).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: config.route.jenis_keperluan_khas_datatable_url},
        "bFilter": true,
        "language": {
            "paginate"  : {
                "previous"  : "Sebelumnya",
                "next"      : "Seterusnya",
            },
            "sSearch"   : "Carian",
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
                return full.id;
            }
        },{
            "aTargets": [ 1 ],
            "width": "30%",
            "mRender": function ( value, type, full )  {
                return full.id_calon;
            }
        },{
            "aTargets": [ 2 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+config.table.table_jenis_keperluan_khas+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+config.table.table_jenis_keperluan_khas+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+config.table.table_jenis_keperluan_khas+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + config.table.table_jenis_keperluan_khas).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + config.table.table_jenis_keperluan_khas + '-label').html("Tambah "  + config.table.table_jenis_keperluan_khas);
        $('#hidden_id_'+ config.table.table_jenis_keperluan_khas).val("");
        $('#action_' + config.table.table_jenis_keperluan_khas).val("add");
        $('#method_' + config.table.table_jenis_keperluan_khas).val("");
        $('#btn-save-' + config.table.table_jenis_keperluan_khas).html("<i class='fa fa-save mr-2'></i> Simpan");
        $('.error_alert').hide();
    });

    /* click edit */
    $('body').on('click', '#edit-' + config.table.table_jenis_keperluan_khas, function ()
    {

        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();


        $.get(config.route.jenis_keperluan_khas_action_url + id +'/edit', function (data) {

            $('#modal' + config.table.table_jenis_keperluan_khas + '-label').html("Kemaskini " + config.table.table_jenis_keperluan_khas);
            $('#btn-save-' + config.table.table_jenis_keperluan_khas).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + config.table.table_jenis_keperluan_khas).val(data.id);
            $('#action_' + config.table.table_jenis_keperluan_khas).val("update");
            $('#method_' + config.table.table_jenis_keperluan_khas).val("PUT");

            $('#input_kod_kecacatan').val(data.kod_kecacatan);
            $('#input_kecacatan_keterangan').val(data.keterangan);

            $('#modal-' + config.table.table_jenis_keperluan_khas ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + config.table.table_jenis_keperluan_khas, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+config.table.table_jenis_keperluan_khas+" dari pangkalan data!",
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
                    url: config.route.jenis_keperluan_khas_action_url + delete_id,
                    success: function (data) {
                        $('#'+config.table.table_jenis_keperluan_khas+'_form').trigger("reset");
                        $('#table-'+config.table.table_jenis_keperluan_khas).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ config.table.table_jenis_keperluan_khas +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+config.table.table_jenis_keperluan_khas+'_form', function(event){

        var errors = $('.error_alert');
        event.preventDefault();

        $('#btn-save-' + config.table.table_jenis_keperluan_khas).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + config.table.table_jenis_keperluan_khas).prop('disabled', true);

        var data = $('#'+config.table.table_jenis_keperluan_khas+'_form').serialize();
        var action = $('#action_' + config.table.table_jenis_keperluan_khas).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + config.table.table_jenis_keperluan_khas).val();
            url = config.route.jenis_keperluan_khas_action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = config.route.jenis_keperluan_khas_store_url;
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

                $('#btn-save-' + config.table.table_jenis_keperluan_khas).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + config.table.table_jenis_keperluan_khas).prop('disabled', false);

                errors.slideDown();

            } else {

                $('#'+config.table.table_jenis_keperluan_khas+'_form').trigger("reset");
                $('#modal-' + config.table.table_jenis_keperluan_khas).modal('hide');
                $('#modal' + config.table.table_jenis_keperluan_khas + '-label').html("Tambah " + config.table.table_jenis_keperluan_khas);
                $('#hidden_id_'+config.table.table_jenis_keperluan_khas).val("");
                $('#action_'+config.table.table_jenis_keperluan_khas).val("add");
                $('#method_'+config.table.table_jenis_keperluan_khas).val("");
                $('#btn-save-'+config.table.table_jenis_keperluan_khas).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+config.table.table_jenis_keperluan_khas).prop('disabled', false);
                $('#table-'+config.table.table_jenis_keperluan_khas).DataTable().ajax.reload();

            }

        });
    });
});
