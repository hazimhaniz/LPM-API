$(function () {

    var data_form = null;

    /* Init Datatable */
    var table = $('#table-' + sekolah.table.name).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:  sekolah.route.datatable_url
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
                return full.kod_sekolah
            }
        },{
            "aTargets": [ 1 ],
            "width": "40%",
            "mRender": function ( value, type, full )  {
                return full.nama_sekolah
            }
        },{
            "aTargets": [ 2 ],
            "width": "40%",
            "mRender": function ( value, type, full )  {
                return full.negeri?.keterangan ?? '-';
            }
        },{
            "aTargets": [ 3 ],
            "width": "20%",
            "sClass": "text-center",
            "mRender": function ( value, type, full )  {
                button_a = '<button type="button" class="btn btn-icon text-dark" title="Edit" id="edit-sekolah" data-id="'+full.id+'"><i class="fa fa-edit"></i></button>';
                button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Delete" id="delete-sekolah" data-id="'+full.id+'" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>';
                return button_a + '|' +  button_b;
            }
        }],
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-sekolah').html("Simpan");
        }
    });

    /* Clear modal form */
    $('#modal-' + sekolah.table.name).on('hidden.bs.modal', function(e){
        e.preventDefault();
        $(this).find('form').trigger('reset');
        $('#modal-' + sekolah.table.name + '-label').html("Tambah "  + sekolah.table.name);
        $('#hidden_id_'+ sekolah.table.name).val("");
        $('#action_' + sekolah.table.name).val("add");
        $('#method_' + sekolah.table.name).val("");
        $('#btn-save-' + sekolah.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
        $('.error_alert').hide();
        $(this).find("select,textarea, input").removeClass('is-invalid');
        data_form = null;
    });

    /* click edit */
    $('body').on('click', '#edit-' + sekolah.table.name, function ()
    {

        var id      = $(this).data('id');
        var info    = $('.error_alert').hide();

        $.get(sekolah.route.action_url + id +'/edit', function (data) {
            console.log(data)
            data_form = data;

            $('#modal-' + sekolah.table.name + '-label').html("Kemaskini " + sekolah.table.name);
            $('#btn-save-' + sekolah.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");
            $('#hidden_id_' + sekolah.table.name).val(data.id);
            $('#action_' + sekolah.table.name).val("update");
            $('#method_' + sekolah.table.name).val("PUT");

            $('#kod_sekolah').val(data.kod_sekolah);
            $('#kod_ppd').val(data.kod_ppd);
            $('#input_nama_sekolah').val(data.nama_sekolah);
            $('#input_nama_pengetua').val(data.nama_pengetua);
            $('#input_nama_sup').val(data.nama_sup);
            $('#input_no_telefon').val(data.no_telefon);
            $('#input_no_faks').val(data.no_faks);
            $('#input_email_sekolah').val(data.emel_sekolah);
            $('#input_alamat_sekolah').val(data.alamat_sekolah);
            $('#input_poskod_sekolah').val(data.poskod);
            $('#select_negeri_sekolah').val(data.id_negeri);
            $('#select_ppd_sekolah').val(data.id_ppd);

            $('#select_lokasi_sekolah').val(data.id_lokasi);
            $('#select_jenis_sekolah').val(data.id_jenis_sekolah);

            $('#modal-' + sekolah.table.name ).modal('show');
        });
    });

    /* click delete */
    $('body').on('click', '#delete-' + sekolah.table.name, function () {
        var delete_id = $(this).data("id");
        Swal.fire({

            title: "Anda pasti?",
            text: "Anda akan memadam rekod "+sekolah.table.name+" dari pangkalan data!",
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
                    url: sekolah.route.action_url + delete_id,
                    success: function (data) {
                        $('#'+sekolah.table.name+'_form').trigger("reset");
                        $('#table-'+sekolah.table.name).DataTable().ajax.reload();
                        Swal.fire("Sudah dipadam!", "Rekod "+ sekolah.table.name +" telah dipadam dari pangkalan data", "success");
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
    $(document).on('submit', '#'+sekolah.table.name+'_form', function(event){

        event.preventDefault();
        $(this).find("select,textarea, input").removeClass('is-invalid');
        $('#btn-save-' + sekolah.table.name).html("<i class='fa fa-circle-o-notch fa-spin mr-1'></i> Sila tunggu..");
        $('#btn-save-' + sekolah.table.name).prop('disabled', true);

        var data = $('#'+sekolah.table.name+'_form').serialize();
        var action = $('#action_' + sekolah.table.name).val();
        var btn_text;

        if (action == 'update') {

            var edit_value = $('#hidden_id_' + sekolah.table.name).val();
            url = sekolah.route.action_url + edit_value;
            type = "POST";
            btn_text = "Kemaskini";

        } else {

            url = sekolah.route.store_url;
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

                $('#btn-save-' + sekolah.table.name).html("<i class='fa fa-save mr-2'></i> " + btn_text);
                $('#btn-save-' + sekolah.table.name).prop('disabled', false);

                errors.slideDown();

            } else {

                $('#'+sekolah.table.name+'_form').trigger("reset");
                $('#modal-' + sekolah.table.name).modal('hide');
                $('#modal' + sekolah.table.name + '-label').html("Tambah " + sekolah.table.name);
                $('#hidden_id_'+sekolah.table.name).val("");
                $('#action_'+sekolah.table.name).val("add");
                $('#method_'+sekolah.table.name).val("");
                $('#btn-save-'+sekolah.table.name).html("<i class='fa fa-save mr-2'></i> Simpan");
                $('#btn-save-'+sekolah.table.name).prop('disabled', false);
                $('#table-'+sekolah.table.name).DataTable().ajax.reload();

            }

        });
    });


    $("#select_negeri_sekolah").on( 'change', function () {
        var value = $(this).find('option:selected').val();
        var selectedIndex = $(this).find('option:selected').index();
        $('#select_daerah_sekolah').find('option').remove();
        $('#select_bandar_sekolah').find('option').remove();
        $('#select_ppd_sekolah').find('option').remove();
        $('#select_parlimen_sekolah').find('option').remove();
        $('#select_dun_sekolah').find('option').remove();

        if (selectedIndex !== '0') {
            $.ajax({
                type: "GET",
                url: sekolah.route.action_url,
                data: {type: 'get_negeri', value: value},
                success: function (data) {
                    $('#select_daerah_sekolah').append($('<option>').text('- Pilih daerah').attr('value', ''));
                    $.each(data,function(key, obj)
                    {
                        $('#select_daerah_sekolah')
                        .append($('<option>')
                        .text(obj.keterangan)
                        .attr('value', obj.id));
                    });

                    $('#select_daerah_sekolah').val(data_form?.id_daerah);
                    $('#select_daerah_sekolah').change();
                },
                error: function (data) {
                    console.log('Error:');
                }
            });
            $.ajax({
                type: "GET",
                url: sekolah.route.action_url,
                data: {type: 'get_ppd', value: value},
                success: function (data) {
                    $('#select_ppd_sekolah').append($('<option>').text('- Pilih PPD').attr('value', ''));
                    $.each(data,function(key, obj)
                    {
                        $('#select_ppd_sekolah')
                        .append($('<option>')
                        .text(obj.nama_ppd)
                        .attr('value', obj.id));
                    });

                    $('#select_ppd_sekolah').val(data_form?.id_ppd);
                },
                error: function (data) {
                    console.log('Error:');
                }
            });
            $.ajax({
                type: "GET",
                url: sekolah.route.action_url,
                data: {type: 'get_parlimen', value: value},
                success: function (data) {

                    $('#select_parlimen_sekolah').append($('<option>').text('- Pilih Parlimen').attr('value', ''));
                    $.each(data,function(key, obj)
                    {
                        $('#select_parlimen_sekolah')
                        .append($('<option>')
                        .text(obj.keterangan)
                        .attr('value', obj.id));
                    });

                    $('#select_parlimen_sekolah').val(data_form?.id_parlimen);
                    $('#select_parlimen_sekolah').change();
                },
                error: function (data) {
                    console.log('Error:');
                }
            });
        }
    } );

    $("#select_parlimen_sekolah").on( 'change', function () {
        var value = $(this).find('option:selected').val();
        var selectedIndex = $(this).find('option:selected').index();
        $('#select_dun_sekolah').find('option').remove();
        if (selectedIndex !== '0') {
            $.ajax({
                type: "GET",
                url: sekolah.route.action_url,
                data: {type: 'get_dun', value: value},
                success: function (data) {
                    $('#select_dun_sekolah').append($('<option>').text('- Pilih DUN').attr('value', ''));
                    $.each(data,function(key, obj)
                    {
                        $('#select_dun_sekolah')
                        .append($('<option>')
                        .text(obj.keterangan)
                        .attr('value', obj.id));
                    });

                    $('#select_dun_sekolah').val(data_form?.id_dun);
                },
                error: function (data) {
                    console.log('Error:');
                }
            });
        }
    } );

    $("#select_daerah_sekolah").on( 'change', function () {
        var value = $(this).find('option:selected').val();
        var selectedIndex = $(this).find('option:selected').index();
        $('#select_bandar_sekolah').find('option').remove();
        if (selectedIndex !== '0') {
            $.ajax({
                type: "GET",
                url: sekolah.route.action_url,
                data: {type: 'get_daerah', value: value},
                success: function (data) {
                    $('#select_bandar_sekolah').append($('<option>').text('- Pilih bandar').attr('value', ''));
                    $.each(data,function(key, obj)
                    {
                        $('#select_bandar_sekolah')
                        .append($('<option>')
                        .text(obj.keterangan)
                        .attr('value', obj.id));
                    });

                    $('#select_bandar_sekolah').val(data_form?.id_bandar);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    } );
});
