$(function () {
    // populate dropdown mata pelajaran 
    // $.ajax({
    //     type: "GET",
    //     url:"/json/matapelajaran",
    //     dataType: "json",
    //     success: function (data) {

    //         $.each(data, function(index, data) {
    //             var option = "<option value="+data.id+">"+data.keterangan+"</option>";
    //             $(option).appendTo('#mata_pelajaran'); 
    //         });  
    //     }
    // });

    /* Init Datatable */
    $('#table-' + jadual_waktu_peperiksaan.table.name).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: jadual_waktu_peperiksaan.route.datatable_url},
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
            "width": "10%",
            "mRender": function ( value, type, full )  {
                return full.id;
            }
        },{
            "aTargets": [ 1 ],
            "width": "40%",
            "mRender": function ( value, type, full )  {
                return full.keterangan;
            }
        },{
            "aTargets": [ 2 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.durasi;
            }
        },{
            "aTargets": [ 3 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.waktu_mula;
            }
        },{
            "aTargets": [ 4 ],
            "width": "20%",
            "mRender": function ( value, type, full )  {
                return full.waktu_tamat;
            }
        },{
            "aTargets": [ 5 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Kemaskini" id="edit-'+jadual_waktu_peperiksaan.table.name+'" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Padam" id="delete-'+jadual_waktu_peperiksaan.table.name+'" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-dark"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+jadual_waktu_peperiksaan.table.name+'').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + jadual_waktu_peperiksaan.table.name).on('hidden.bs.modal', function(e){
        $(this).find('form').trigger('reset');
        $('#modal-' + jadual_waktu_peperiksaan.table.name + '-label').html("Tambah "  + jadual_waktu_peperiksaan.table.name);
        $('#hidden_id_'+ jadual_waktu_peperiksaan.table.name).val("");
        $('#action_' + jadual_waktu_peperiksaan.table.name).val("add");
        $('#method_' + jadual_waktu_peperiksaan.table.name).val("");
        $('#btn-save-' + jadual_waktu_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $('.error_alert').hide();
    });

    /* click edit */
    $('body').on('click', '#edit-' + jadual_waktu_peperiksaan.table.name, function () 
    {
        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();

        $.get(jadual_waktu_peperiksaan.route.action_url + id +'/edit', function (data) {
            $('#modal' + jadual_waktu_peperiksaan.table.name + '-label').html("Kemaskini " + jadual_waktu_peperiksaan.table.name);
            $('#btn-save-' + jadual_waktu_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + jadual_waktu_peperiksaan.table.name).val(data.id);
            $('#action_' + jadual_waktu_peperiksaan.table.name).val("update");
            $('#method_' + jadual_waktu_peperiksaan.table.name).val("PUT");

            $('#input_tempoh_masa').val(data.tempoh_masa);
            $('#input_tarikh_mula').val(data.tarikh_mula);
            $('#input_tarikh_tamat').val(data.tarikh_tamat);

            $('#modal-' + jadual_waktu_peperiksaan.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + jadual_waktu_peperiksaan.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+jadual_waktu_peperiksaan.table.name+" dari pangkalan data!",
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
                    url: jadual_waktu_peperiksaan.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+jadual_waktu_peperiksaan.table.name+'_form').trigger("reset");
                        $('#table-'+jadual_waktu_peperiksaan.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ jadual_waktu_peperiksaan.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+jadual_waktu_peperiksaan.table.name+'_form', function(event){

        var errors = $('.error_alert');
        event.preventDefault();

        $('#btn-save-' + jadual_waktu_peperiksaan.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + jadual_waktu_peperiksaan.table.name).prop('disabled', true);

        var data = $('#'+jadual_waktu_peperiksaan.table.name+'_form').serialize();
        var action = $('#action_' + jadual_waktu_peperiksaan.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + jadual_waktu_peperiksaan.table.name).val();
            url = jadual_waktu_peperiksaan.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = jadual_waktu_peperiksaan.route.store_url;
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

                $('#btn-save-' + jadual_waktu_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + jadual_waktu_peperiksaan.table.name).prop('disabled', false);

                errors.slideDown();

            } else {

                $('#'+jadual_waktu_peperiksaan.table.name+'_form').trigger("reset");
                $('#modal-' + jadual_waktu_peperiksaan.table.name).modal('hide');
                $('#modal' + jadual_waktu_peperiksaan.table.name + '-label').html("Tambah " + jadual_waktu_peperiksaan.table.name);
                $('#hidden_id_'+jadual_waktu_peperiksaan.table.name).val("");
                $('#action_'+jadual_waktu_peperiksaan.table.name).val("add");
                $('#method_'+jadual_waktu_peperiksaan.table.name).val("");
                $('#btn-save-'+jadual_waktu_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+jadual_waktu_peperiksaan.table.name).prop('disabled', false);
                $('#table-'+jadual_waktu_peperiksaan.table.name).DataTable().ajax.reload();

            }
        });
    });
});
