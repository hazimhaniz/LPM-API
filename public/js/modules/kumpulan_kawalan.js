import * as Helper from '../helper.js'

/*
*   INIT DATATABLE
*/
Helper.loadDatable(
    kumpulan_kawalan.table.name,
    '#table-kumpulan-kawalan',
    kumpulan_kawalan.route.datatable_url,
    [
        {
            width: '20%',
            display: 'id'
        },
        {
            width: '20%',
            display: 'name'
        },
        {
            width: '20%',
            display: 'description'
        },
        {
            width: '29%',
            className: 'text-center',
            display: 'id'
        }
    ]
)

/*
*   CLEAR MODAL ON CLOSE
*/
Helper.clearModal('#modal-kumpulan-kawalan')

/*
*   EDIT MODAL
*/
$('body').on('click', '#edit-'+kumpulan_kawalan.table.name, async function (){

    let id    = $(this).data('id');
    let data  = null

    data = await Helper.getData({
        url: kumpulan_kawalan.route.action_url + '/' + id + '/edit',
    })

    $.each(data, function(index, data) {

        if (index == 'name') {
            $("#"+index).attr('readonly', true)
        }
        $("#"+index).val(data)
    })

    $('#modal' + kumpulan_kawalan.table.name + '-label').html("Kemaskini " + kumpulan_kawalan.table.name);
    $('#btn-save-' + kumpulan_kawalan.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");

    $('#modal-' + kumpulan_kawalan.table.name ).modal('show');
});

/*
*   SUBMIT POST AJAX FORM
*/
$('#kumpulan-kawalan_form').on('submit', function(e){

    e.preventDefault()                              //prevent default action 
    let post_url        = $(this).attr("action")    //get form action url
    let request_method  = $(this).attr("method")    //get form GET/POST method
    let form_data       = new FormData(this)        //Encode form elements for submission

    Helper.ajaxForm({
        title: 'Berjaya menambah kumpulan kawalan baharu.',
        message: 'Anda telah berjaya menambah kumpulan kawalan baharu.',
        type: request_method,
        url: post_url,
        form: form_data,
    })
})

/**
 * 
 * ON DELETE
 * 
 */
 $('body').on('click', '#delete-' + kumpulan_kawalan.table.name, function () {
    var delete_id = $(this).data("id");

    Helper.sweetalert(
        kumpulan_kawalan.table.name,
        {
            url: kumpulan_kawalan.route.action_url +'/'+ delete_id
        }
    )
 })