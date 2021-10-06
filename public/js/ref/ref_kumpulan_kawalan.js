$(function () {

    /* Init Datatable */
    var table = $('#table-' + kumpulan_kawalan.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: kumpulan_kawalan.route.datatable_url},
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
                return full.id;
            }
        },{
            "aTargets": [ 1 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.name;
            }
        },{
            "aTargets": [ 2 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.description;
            }
        },{
            "aTargets": [ 3 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+kumpulan_kawalan.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+kumpulan_kawalan.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+kumpulan_kawalan.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + kumpulan_kawalan.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + kumpulan_kawalan.table.name + '-label').html("Tambah "  + kumpulan_kawalan.table.name);
        $('#hidden_id_'+ kumpulan_kawalan.table.name).val("");
        $('#action_' + kumpulan_kawalan.table.name).val("add");
        $('#method_' + kumpulan_kawalan.table.name).val("");
        $('#btn-save-' + kumpulan_kawalan.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $('.error_alert').hide();
    });

    /* click edit */
    $('body').on('click', '#edit-' + kumpulan_kawalan.table.name, function () 
    {

        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();

        
        $.get(kumpulan_kawalan.route.action_url + id +'/edit', function (data) {

            $('#modal-' + kumpulan_kawalan.table.name + '-label').html("Kemaskini " + kumpulan_kawalan.table.name);
            $('#btn-save-' + kumpulan_kawalan.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + kumpulan_kawalan.table.name).val(data.id);
            $('#action_' + kumpulan_kawalan.table.name).val("update");
            $('#method_' + kumpulan_kawalan.table.name).val("PUT");

            $('#input_peranan_nama').val(data.name);
            $('#input_peranan_penerangan').val(data.description);

            $('#modal-' + kumpulan_kawalan.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + kumpulan_kawalan.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+kumpulan_kawalan.table.name+" dari pangkalan data!",
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
                    url: kumpulan_kawalan.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+kumpulan_kawalan.table.name+'_form').trigger("reset");
                        $('#table-'+kumpulan_kawalan.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ kumpulan_kawalan.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+kumpulan_kawalan.table.name+'_form', function(event){

        var errors = $('.error_alert');
        event.preventDefault();

        $('#btn-save-' + kumpulan_kawalan.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + kumpulan_kawalan.table.name).prop('disabled', true);

        var data = $('#'+kumpulan_kawalan.table.name+'_form').serialize();
        var action = $('#action_' + kumpulan_kawalan.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + kumpulan_kawalan.table.name).val();
            url = kumpulan_kawalan.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = kumpulan_kawalan.route.store_url;
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

                $('#btn-save-' + kumpulan_kawalan.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + kumpulan_kawalan.table.name).prop('disabled', false);

                errors.slideDown();

            } else {

                $('#'+kumpulan_kawalan.table.name+'_form').trigger("reset");
                $('#modal-' + kumpulan_kawalan.table.name).modal('hide');
                $('#modal' + kumpulan_kawalan.table.name + '-label').html("Tambah " + kumpulan_kawalan.table.name);
                $('#hidden_id_'+kumpulan_kawalan.table.name).val("");
                $('#action_'+kumpulan_kawalan.table.name).val("add");
                $('#method_'+kumpulan_kawalan.table.name).val("");
                $('#btn-save-'+kumpulan_kawalan.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+kumpulan_kawalan.table.name).prop('disabled', false);
                $('#table-'+kumpulan_kawalan.table.name).DataTable().ajax.reload();

            }

        });
    });

    
    $("#select_kumpulan_kawalan_negeri").on( 'change', function () {
        var value = $(this).find('option:selected').val();
        var selectedIndex = $(this).find('option:selected').index();
        $('#select_kumpulan_kawalan_parlimen').find('option').remove();

        if (selectedIndex !== '0') {
            $.ajax({
                type: "GET",
                url: kumpulan_kawalan.route.action_url,
                data: {type: 'get_negeri', value: value},
                success: function (data) {

                    $('#select_kumpulan_kawalan_parlimen').append($('<option>').text('- Pilih parlimen').attr('value', ''));
                    $.each(data,function(key, obj)
                    {
                        $('#select_kumpulan_kawalan_parlimen')
                        .append($('<option>')
                        .text(obj.keterangan)
                        .attr('value', obj.parlimen_id));
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    } );
});
