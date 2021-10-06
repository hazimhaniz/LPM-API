import * as Helper from '../helper.js'

/*
*   INIT DATATABLE
*/
Helper.loadDatable(
    pengguna.table.name,
    '#table-pengguna',
    pengguna.route.datatable_url,
    [
        {
            width: '20%',
            display: 'id'
        },
        {
            width: '20%',
            display: 'kru.nama'
        },
        {
            width: '20%',
            display: 'id_pengguna'
        },
        {
            width: '20%',
            display: 'roles.0.description'
        },
        {
            width: '29%',
            display: 'id'
        }
    ]
)

/*
*   EDIT MODAL
*/
$('body').on('click', '#edit-'+pengguna.table.name, async function (){

    let id    = $(this).data('id');
    let data  = null

    data = await Helper.getData({
        url: pengguna.route.action_url + '/' + id + '/edit',
    })

    // maklumat pengguna
    $('#select_peranan').val(data.roles[0]?.id).prop('disabled', true)
    $('#id_pengguna').val(data.id_pengguna).attr('readonly', true)
    $('#email').val(data.kru?.emel).attr('readonly', true)
    
    // maklumat personal
    $('#name').val(data.kru?.nama).attr('readonly', true)
    $('#ic').val(data.kru?.no_kad_pengenalan).attr('readonly', true)
    $('#phone').val(data.kru?.no_telefon_bimbit)
    
    // address
    $('#address').val(data.kru?.alamat?.alamat)
    $('#postcode').val(data.kru?.alamat?.poskod)
    $('#select_pengguna_negeri').val(data.kru?.alamat?.id_negeri).attr('selected', true)
    $('#select_pengguna_bandar').val(data.kru?.alamat?.id_bandar)

    $('#modal' + pengguna.table.name + '-label').html("Kemaskini " + pengguna.table.name);
    $('#btn-save-' + pengguna.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");

    $('#modal-' + pengguna.table.name ).modal('show');
});

/*
*   CLEAR MODAL ON CLOSE
*/
Helper.clearModal('#modal-pengguna')

/*
*   SUBMIT POST AJAX FORM
*/
$('#pengguna_form').on('submit', function(e){

    e.preventDefault()                              //prevent default action 
    let post_url        = $(this).attr("action")    //get form action url
    let request_method  = $(this).attr("method")    //get form GET/POST method
    let form_data       = new FormData(this)        //Encode form elements for submission

    Helper.ajaxForm({
        title: 'Berjaya membuat pengguna baharu.',
        message: 'Anda telah berjaya membuat pengguna baharu.',
        type: request_method,
        url: post_url,
        form: form_data,
    })
})

/*
*   LOAD BANDAR
*/
$("#select_pengguna_negeri").on( 'change', function () {

    var value = $(this).find('option:selected').val();
    $('#select_pengguna_bandar').find('option').remove();

    Helper.getData({
        url: pengguna.route.bandar_url,
        data: {type: 'get_bandar', value: value},
    }).then( (data) => 

        $.each(data, function(index, data) {

            let option = "<option value="+data.id+">"+data.keterangan+"</option>"
            $(option).appendTo('#select_pengguna_bandar')
        })
    ).catch((e) => console.error(e))
});

/**
 * 
 * ON DELETE
 * 
 */
 $('body').on('click', '#delete-' + pengguna.table.name, function () {
    var delete_id = $(this).data("id");

    Helper.sweetalert(
        pengguna.table.name,
        {
            url: pengguna.route.action_url +'/'+ delete_id
        }
    )
 })

/**
 * 
 * PERANAN ON CHANGE
 * 
 */
 $("#select_peranan").on( 'change', function () {

    if( $(this).find('option:selected').val() == 3 ){
       
        $(".select_sekolah_pengguna").show()
        
        $(".select_negeri_pengguna").show()

        $("#select_negeri_pengguna").on( 'change', function() {

            let value = $(this).find('option:selected').val();
            $('#select_sekolah_pengguna').find('option').remove();

            Helper.getData({
                url: pengguna.route.sekolah_url,
                data: {type: 'get_sekolah', value: value},

            }).then( (data) => 
              
                $.each(data, function(index, data) {

                    let option = "<option value="+data.id+">"+data.nama_sekolah+"</option>"
                    $(option).appendTo('#select_sekolah_pengguna')
                })

               
            ).catch((e) => console.error(e))
        });
       
        $('#select_sekolah_pengguna').on('change', function() {

            let value = $(this).find('option:selected').val();

            Helper.getData({
                url: pengguna.route.sekolah_url,
                data: {type: null, value: value},
    
            }).then( (data) => 

               $('#id_pengguna').val('SUP'+data.kod_sekolah).attr('readonly', true)
               
            ).catch((e) => console.error(e))
        })
       
    }else if($(this).find('option:selected').val() == 6){

        $(".select_negeri_pengguna").show()
        $(".select_sekolah_pengguna").css("display", "none")
        $("#select_sekolah_pengguna").val('')
        $('#id_pengguna').val('').attr('readonly', false)

    }else{

        $(".select_negeri_pengguna").css("display", "none")
        $(".select_sekolah_pengguna").css("display", "none")
        $("#select_sekolah_pengguna").val('')
        $('#id_pengguna').val('').attr('readonly', false)
    }
});