$(function () {
    $('#replication_data').on('click', function(){
        if($(this).is(':checked')){

            $('.c_pilih_tahun').empty()
            $('#pilih_tahun').val("")
            $('#label_pilih_tahun').hide()
            $('#pilih_tahun').hide()
           
            $('#label_pilih_tahun_replicate').show()
            $('#pilih_tahun_replicate').show()
        } else {
           
            $('.c_pilih_tahun_replicate').empty()
            $('#pilih_tahun_replicate').val("")
            $('#label_pilih_tahun_replicate').hide()
            $('#pilih_tahun_replicate').hide()
            $('#label_pilih_tahun').show()
            $('#pilih_tahun').show()
            
        }
    });

    // hidden@clear modal
    function hideModal(){
        $('#replicationYear').on('hidden.bs.modal', function(e){
            $(this).find('form').trigger('reset')
            $('#label_pilih_tahun_replicate').hide()
            $('#pilih_tahun_replicate').hide()
            $('#label_pilih_tahun').show()
            $('#pilih_tahun').show()
            $('#pilih_tahun_replicate').val("")
            $(this).find("select,textarea, input").removeClass('is-invalid')
        });
    }

    $('#btn_save').on('click', function(evt) {
        
        evt.preventDefault()

        $.ajax({
            url: $('#form_tahun_peperiksaan').prop('action'),
            type: 'post',
            dataType: 'json',
            data: $('#form_tahun_peperiksaan').serialize(),
            success: function(data) {
                hideModal()
                location.reload()
            },
            error: function (data) {

                $('#form_tahun_peperiksaan').find("select,textarea, input").removeClass('is-invalid')

                if(data.responseJSON?.errors){
                    $.each(data.responseJSON.errors, function(index, error){

                        $('[name='+index+']').addClass("is-invalid")
                        $('.c_'+index).html(error)
                    })
                
                }
            }
        });
    });
})