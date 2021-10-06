$(function () {

    /* Init Datatable */
    var table = $('#table-' + ppd.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: ppd.route.datatable_url},
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
                return full.kod_ppd;
            }
        },{
            "aTargets": [ 1 ],
            "width": "30%",
            "mRender": function ( value, type, full )  {
                return full.nama_ppd;
            }
        },{
            "aTargets": [ 2 ],
            "width": "30%",
            "mRender": function ( value, type, full )  {
                return full.negeri?.keterangan ?? '-';
            }
        },{
            "aTargets": [ 3 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+ppd.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+ppd.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+ppd.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + ppd.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + ppd.table.name + '-label').html("Tambah "  + ppd.table.name);
        $('#hidden_id_'+ ppd.table.name).val("");
        $('#action_' + ppd.table.name).val("add");
        $('#method_' + ppd.table.name).val("");
        $('#btn-save-' + ppd.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $('.error_alert').hide();
    });

    /* click edit */
    $('body').on('click', '#edit-' + ppd.table.name, function () 
    {

        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();

        $.get(ppd.route.action_url + id +'/edit', function (data) {

            $('#modal' + ppd.table.name + '-label').html("Kemaskini " + ppd.table.name);
            $('#btn-save-' + ppd.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + ppd.table.name).val(data.id);
            $('#action_' + ppd.table.name).val("update");
            $('#method_' + ppd.table.name).val("PUT");

            $('#input_kod_ppd').val(data.kod_ppd);
            $('#input_nama_ppd').val(data.nama_ppd);
            $('#select_ppd_negeri').val(data.id_negeri);
            
            $('#modal-' + ppd.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + ppd.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+ppd.table.name+" dari pangkalan data!",
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
                    url: ppd.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+ppd.table.name+'_form').trigger("reset");
                        $('#table-'+ppd.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ ppd.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+ppd.table.name+'_form', function(event){

        var errors = $('.error_alert');
        event.preventDefault();

        $('#btn-save-' + ppd.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + ppd.table.name).prop('disabled', true);

        var data = $('#'+ppd.table.name+'_form').serialize();
        var action = $('#action_' + ppd.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + ppd.table.name).val();
            url = ppd.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = ppd.route.store_url;
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

                $('#btn-save-' + ppd.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + ppd.table.name).prop('disabled', false);

                errors.slideDown();

            } else {

                $('#'+ppd.table.name+'_form').trigger("reset");
                $('#modal-' + ppd.table.name).modal('hide');
                $('#modal' + ppd.table.name + '-label').html("Tambah " + ppd.table.name);
                $('#hidden_id_'+ppd.table.name).val("");
                $('#action_'+ppd.table.name).val("add");
                $('#method_'+ppd.table.name).val("");
                $('#btn-save-'+ppd.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+ppd.table.name).prop('disabled', false);
                $('#table-'+ppd.table.name).DataTable().ajax.reload();

            }

        });
    });
});
