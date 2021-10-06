$(function () {

    /* Init Datatable */
    var table = $('#table-' + dun.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: dun.route.datatable_url},
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
                return full.kod_dun;
            }
        },{
            "aTargets": [ 1 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.keterangan ?? '-';
            }
        },{
            "aTargets": [ 2 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.negeri?.keterangan ?? '-';
            }
        },{
            "aTargets": [ 3 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.parlimen?.keterangan ?? '-';
            }
        },{
            "aTargets": [ 4 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+dun.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+dun.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+dun.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + dun.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + dun.table.name + '-label').html("Tambah "  + dun.table.name);
        $('#hidden_id_'+ dun.table.name).val("");
        $('#action_' + dun.table.name).val("add");
        $('#method_' + dun.table.name).val("");
        $('#btn-save-' + dun.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $(this).find("select,textarea, input").removeClass('is-invalid');
    });

    /* click edit */
    $('body').on('click', '#edit-' + dun.table.name, function () 
    {

        var id      = $(this).data('id');
        
        $.get(dun.route.action_url + id +'/edit', function (data) {

            $('#modal' + dun.table.name + '-label').html("Kemaskini " + dun.table.name);
            $('#btn-save-' + dun.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + dun.table.name).val(data.id);
            $('#action_' + dun.table.name).val("update");
            $('#method_' + dun.table.name).val("PUT");

            $('#input_kod_dun').val(data.kod_dun);
            $('#input_keterangan_dun').val(data.keterangan);
            $('#select_dun_negeri').val(data.id_negeri);

            $("#select_dun_negeri").change();

            setTimeout(function(){
                $('#select_dun_parlimen').val(data.kod_parlimen);
            }, 500);

            $('#modal-' + dun.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + dun.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+dun.table.name+" dari pangkalan data!",
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
                    url: dun.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+dun.table.name+'_form').trigger("reset");
                        $('#table-'+dun.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ dun.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+dun.table.name+'_form', function(event){

        event.preventDefault();
        $(this).find("select,textarea, input").removeClass('is-invalid');
        $('#btn-save-' + dun.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + dun.table.name).prop('disabled', true);

        var data = $('#'+dun.table.name+'_form').serialize();
        var action = $('#action_' + dun.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + dun.table.name).val();
            url = dun.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = dun.route.store_url;
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

                $('#btn-save-' + dun.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + dun.table.name).prop('disabled', false);

            } else {

                $('#'+dun.table.name+'_form').trigger("reset");
                $('#modal-' + dun.table.name).modal('hide');
                $('#modal' + dun.table.name + '-label').html("Tambah " + dun.table.name);
                $('#hidden_id_'+dun.table.name).val("");
                $('#action_'+dun.table.name).val("add");
                $('#method_'+dun.table.name).val("");
                $('#btn-save-'+dun.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+dun.table.name).prop('disabled', false);
                $('#table-'+dun.table.name).DataTable().ajax.reload();

            }

        });
    });

    
    $("#select_dun_negeri").on( 'change', function () {
        var value = $(this).find('option:selected').val();
        var selectedIndex = $(this).find('option:selected').index();
        $('#select_dun_parlimen').find('option').remove();

        if (selectedIndex !== '0') {
            $.ajax({
                type: "GET",
                url: dun.route.action_url,
                data: {type: 'get_negeri', value: value},
                success: function (data) {

                    $('#select_dun_parlimen').append($('<option>').text('- Pilih parlimen').attr('value', ''));
                    $.each(data,function(key, obj)
                    {
                        $('#select_dun_parlimen')
                        .append($('<option>')
                        .text(obj.keterangan)
                        .attr('value', obj.kod_parlimen));
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    } );
});
