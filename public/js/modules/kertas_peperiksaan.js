import * as Helper from '../helper.js'

/*
*   INIT DATATABLE
*/
Helper.loadDatable(
    kertas_peperiksaan.table.name,
    '#table-kertas-peperiksaan',
    kertas_peperiksaan.route.datatable_url,
    [
        {
            width: '20%',
            display: 'kod_kertas_peperiksaan'
        },
        {
            width: '20%',
            display: 'nama_kertas_peperiksaan'
        },
        {
            width: '20%',
            display: 'jenis_kertas'
        },
        {
            width: '20%',
            display: 'bahasa'
        },
        {
            width: '29%',
            display: 'id'
        }
    ]
)

/*
*   LOAD MATAPELAJARAN
*/
Helper.getData({
    url: '/json/matapelajaran',
}).then( (data) => 
    $.each(data, function(index, data) {
        let option = "<option value="+data.id+">"+data.keterangan+"</option>"
        $(option).appendTo('#id_mata_pelajaran')
    })
).catch((e) => console.error(e))

/*
*   CLEAR MODAL ON CLOSE
*/
Helper.clearModal('#modal-kertas-peperiksaan')

/*
*   SUBMIT POST AJAX FORM
*/
$('#kertas-peperiksaan_form').on('submit', function(e){

    e.preventDefault()                              //prevent default action 
    let post_url        = $(this).attr("action")    //get form action url
    let request_method  = $(this).attr("method")    //get form GET/POST method
    let form_data       = new FormData(this)        //Encode form elements for submission
  
    let calon           = []

    $('input:checkbox[name="calon[]"]:checked').each(function() {
        calon.push($(this).val());
    });

    let jsonObjCalon = JSON.stringify(calon)
    form_data.append("calon", jsonObjCalon)

    Helper.ajaxForm({
        title: 'Berjaya simpan kertas peperiksaan.',
        message: 'Anda telah berjaya menyimpan kertas peperiksaan.',
        type: request_method,
        url: post_url,
        form: form_data,
    })
})

/*
*   EDIT MODAL
*/
$('body').on('click', '#edit-'+kertas_peperiksaan.table.name, async function (){

    let id    = $(this).data('id');
    let data  = null

    data = await Helper.getData({
        url: kertas_peperiksaan.route.action_url + '/' + id + '/edit',
    })

    $.each(data, function(index, data) {

        const inputOpt = ['kertas_hurdle', 'kertas_matriks', 'dikira_gred', 'lpm', 'penentuan_standard']
       
        if (inputOpt.indexOf(index) != -1) {

            $("#"+index).val(data).prop('checked', data)

        } else if (index == 'calon') {
           
            $.each(JSON.parse(data), function(key, calon){
                $('input:checkbox[name="calon[]"]').val(calon).prop('checked', true)
            })

        } else {

            $("#"+index).val(data)
        }
    })

    $('#modal' + kertas_peperiksaan.table.name + '-label').html("Kemaskini " + kertas_peperiksaan.table.name);
    $('#btn-save-' + kertas_peperiksaan.table.name).html("<i class='fa fa-save mr-2'></i> Kemaskini");

    $('#modal-' + kertas_peperiksaan.table.name ).modal('show');
});