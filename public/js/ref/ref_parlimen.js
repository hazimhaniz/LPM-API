$(function () {

    /* Init Datatable */
    var table = $('#table-' + parlimen.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: parlimen.route.datatable_url},
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
                return full.kod_parlimen;
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
                return full.negeri?.keterangan ?? '-';
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
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+parlimen.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+parlimen.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+parlimen.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + parlimen.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + parlimen.table.name + '-label').html("Tambah "  + parlimen.table.name);
        $('#hidden_id_'+ parlimen.table.name).val("");
        $('#action_' + parlimen.table.name).val("add");
        $('#method_' + parlimen.table.name).val("");
        $('#btn-save-' + parlimen.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $(this).find("select,textarea, input").removeClass('is-invalid');
    });

    /* click edit */
    $('body').on('click', '#edit-' + parlimen.table.name, function () 
    {

        var id      = $(this).data('id');
        
        $.get(parlimen.route.action_url + id +'/edit', function (data) {

            $('#modal' + parlimen.table.name + '-label').html("Kemaskini " + parlimen.table.name);
            $('#btn-save-' + parlimen.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + parlimen.table.name).val(data.id);
            $('#action_' + parlimen.table.name).val("update");
            $('#method_' + parlimen.table.name).val("PUT");

            $('#input_kod_parlimen').val(data.kod_parlimen);
            $('#input_keterangan_parlimen').val(data.keterangan);
            $('#select_parlimen_negeri').val(data.id_negeri);
            $('#select_kod_ppd').val(data.id_kod_ppd);

            $('#modal-' + parlimen.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + parlimen.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+parlimen.table.name+" dari pangkalan data!",
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
                    url: parlimen.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+parlimen.table.name+'_form').trigger("reset");
                        $('#table-'+parlimen.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ parlimen.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+parlimen.table.name+'_form', function(event){

        event.preventDefault();
        $(this).find("select,textarea, input").removeClass('is-invalid');
        $('#btn-save-' + parlimen.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + parlimen.table.name).prop('disabled', true);

        var data = $('#'+parlimen.table.name+'_form').serialize();
        var action = $('#action_' + parlimen.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + parlimen.table.name).val();
            url = parlimen.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = parlimen.route.store_url;
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

                $('#btn-save-' + parlimen.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + parlimen.table.name).prop('disabled', false);

            } else {

                $('#'+parlimen.table.name+'_form').trigger("reset");
                $('#modal-' + parlimen.table.name).modal('hide');
                $('#modal' + parlimen.table.name + '-label').html("Tambah " + parlimen.table.name);
                $('#hidden_id_'+parlimen.table.name).val("");
                $('#action_'+parlimen.table.name).val("add");
                $('#method_'+parlimen.table.name).val("");
                $('#btn-save-'+parlimen.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+parlimen.table.name).prop('disabled', false);
                $('#table-'+parlimen.table.name).DataTable().ajax.reload();

            }

        });
    });
});
