$(function () {

    /* Init Datatable */
    var table = $('#table-' + kawalan_sistem.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: kawalan_sistem.route.datatable_url},
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
                var sub_permissions = full.sub_permissions;
                var value = '';

                sub_permissions.forEach($data => {
                    value += '- ' + $data.name+ '<br>';
                });
                return value;
            }
        },{
            "aTargets": [ 3 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+kawalan_sistem.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+kawalan_sistem.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+kawalan_sistem.table.name+'').html("Simpan");
        }
    });

    var max = 10;
    var cnt = 1;

    $(".tambah-input").on("click", function(e){
        e.preventDefault();
        if(cnt < max){
            cnt++;
            $(".input-wrapper").append('<div class="input-group mb-3"><input type="text" name="sub_permissions[]" class="form-control" required/><span class="input-group-btn"><button type="button" class="btn btn-danger ml-3 padam-input">Padam</button></span></div>');
        }
    });

    $(".input-wrapper").on("click",".padam-input", function(e){
        e.preventDefault();
        $(this).parents(".input-group").remove();
        cnt--;
    });

    /* Clear modal form */
    $('#modal-' + kawalan_sistem.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + kawalan_sistem.table.name + '-label').html("Tambah "  + kawalan_sistem.table.name);
        $('#hidden_id_'+ kawalan_sistem.table.name).val("");
        $('#action_' + kawalan_sistem.table.name).val("add");
        $('#method_' + kawalan_sistem.table.name).val("");
        $('#btn-save-' + kawalan_sistem.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $(".input-wrapper").html('');
        $('.error_alert').hide();
    });

    /* click edit */
    $('body').on('click', '#edit-' + kawalan_sistem.table.name, function () 
    {

        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();

        

        
        $.get(kawalan_sistem.route.action_url + id +'/edit', function (data) {

            data.sub_permissions.forEach(sub => {
                $(".input-wrapper").append('<div class="input-group mb-3"><input type="text" name="sub_permissions[]" value="'+ sub.name +'" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-danger ml-3 padam-input">Padam</button></span></div>');
            });

            $('#modal-' + kawalan_sistem.table.name + '-label').html("Kemaskini " + kawalan_sistem.table.name);
            $('#btn-save-' + kawalan_sistem.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + kawalan_sistem.table.name).val(data.id);
            $('#action_' + kawalan_sistem.table.name).val("update");
            $('#method_' + kawalan_sistem.table.name).val("PUT");

            
            $('#input_kawalan_sistem_nama').val(data.name);
            $('#input_kawalan_sistem_penerangan').val(data.description)

            $('#modal-' + kawalan_sistem.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + kawalan_sistem.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+kawalan_sistem.table.name+" dari pangkalan data!",
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
                    url: kawalan_sistem.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+kawalan_sistem.table.name+'_form').trigger("reset");
                        $('#table-'+kawalan_sistem.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ kawalan_sistem.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+kawalan_sistem.table.name+'_form', function(event){

        var errors = $('.error_alert');
        event.preventDefault();

        $('#btn-save-' + kawalan_sistem.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + kawalan_sistem.table.name).prop('disabled', true);

        var data = $('#'+kawalan_sistem.table.name+'_form').serialize();
        var action = $('#action_' + kawalan_sistem.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + kawalan_sistem.table.name).val();
            url = kawalan_sistem.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = kawalan_sistem.route.store_url;
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

                $('#btn-save-' + kawalan_sistem.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + kawalan_sistem.table.name).prop('disabled', false);

                errors.slideDown();

            } else {

                $('#'+kawalan_sistem.table.name+'_form').trigger("reset");
                $('#modal-' + kawalan_sistem.table.name).modal('hide');
                $('#modal' + kawalan_sistem.table.name + '-label').html("Tambah " + kawalan_sistem.table.name);
                $('#hidden_id_'+kawalan_sistem.table.name).val("");
                $('#action_'+kawalan_sistem.table.name).val("add");
                $('#method_'+kawalan_sistem.table.name).val("");
                $('#btn-save-'+kawalan_sistem.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+kawalan_sistem.table.name).prop('disabled', false);
                $('#table-'+kawalan_sistem.table.name).DataTable().ajax.reload();

            }

        });
    });

    
    $("#select_kawalan_sistem_negeri").on( 'change', function () {
        var value = $(this).find('option:selected').val();
        var selectedIndex = $(this).find('option:selected').index();
        $('#select_kawalan_sistem_parlimen').find('option').remove();

        if (selectedIndex !== '0') {
            $.ajax({
                type: "GET",
                url: kawalan_sistem.route.action_url,
                data: {type: 'get_negeri', value: value},
                success: function (data) {

                    $('#select_kawalan_sistem_parlimen').append($('<option>').text('- Pilih parlimen').attr('value', ''));
                    $.each(data,function(key, obj)
                    {
                        $('#select_kawalan_sistem_parlimen')
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
