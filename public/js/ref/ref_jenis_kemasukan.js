$(function () {

    /* Init Datatable */
    var table = $('#table-' + jenis_kemasukan.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: jenis_kemasukan.route.datatable_url},
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
                return full.kod_kemasukan;
            }
        },{
            "aTargets": [ 1 ],
            "width": "60%",
            "mRender": function ( value, type, full )  {
                return full.keterangan;
            }
        },{
            "aTargets": [ 2 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+jenis_kemasukan.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+jenis_kemasukan.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+jenis_kemasukan.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + jenis_kemasukan.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + jenis_kemasukan.table.name + '-label').html("Tambah "  + jenis_kemasukan.table.name);
        $('#hidden_id_'+ jenis_kemasukan.table.name).val("");
        $('#action_' + jenis_kemasukan.table.name).val("add");
        $('#method_' + jenis_kemasukan.table.name).val("");
        $('#btn-save-' + jenis_kemasukan.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $('.error_alert').hide();
    });

    /* click edit */
    $('body').on('click', '#edit-' + jenis_kemasukan.table.name, function ()
    {

        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();


        $.get(jenis_kemasukan.route.action_url + id +'/edit', function (data) {

            $('#modal' + jenis_kemasukan.table.name + '-label').html("Kemaskini " + jenis_kemasukan.table.name);
            $('#btn-save-' + jenis_kemasukan.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + jenis_kemasukan.table.name).val(data.id);
            $('#action_' + jenis_kemasukan.table.name).val("update");
            $('#method_' + jenis_kemasukan.table.name).val("PUT");

            $('#input_kod_kemasukan').val(data.kod_kemasukan);
            $('#input_kemasukan_keterangan').val(data.keterangan);

            $('#modal-' + jenis_kemasukan.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + jenis_kemasukan.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+jenis_kemasukan.table.name+" dari pangkalan data!",
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
                    url: jenis_kemasukan.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+jenis_kemasukan.table.name+'_form').trigger("reset");
                        $('#table-'+jenis_kemasukan.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ jenis_kemasukan.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+jenis_kemasukan.table.name+'_form', function(event){

        var errors = $('.error_alert');
        event.preventDefault();

        $('#btn-save-' + jenis_kemasukan.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + jenis_kemasukan.table.name).prop('disabled', true);

        var data = $('#'+jenis_kemasukan.table.name+'_form').serialize();
        var action = $('#action_' + jenis_kemasukan.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + jenis_kemasukan.table.name).val();
            url = jenis_kemasukan.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = jenis_kemasukan.route.store_url;
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

                $('#btn-save-' + jenis_kemasukan.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + jenis_kemasukan.table.name).prop('disabled', false);

                errors.slideDown();

            } else {

                $('#'+jenis_kemasukan.table.name+'_form').trigger("reset");
                $('#modal-' + jenis_kemasukan.table.name).modal('hide');
                $('#modal' + jenis_kemasukan.table.name + '-label').html("Tambah " + jenis_kemasukan.table.name);
                $('#hidden_id_'+jenis_kemasukan.table.name).val("");
                $('#action_'+jenis_kemasukan.table.name).val("add");
                $('#method_'+jenis_kemasukan.table.name).val("");
                $('#btn-save-'+jenis_kemasukan.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+jenis_kemasukan.table.name).prop('disabled', false);
                $('#table-'+jenis_kemasukan.table.name).DataTable().ajax.reload();

            }

        });
    });
});
