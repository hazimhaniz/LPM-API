/*
*   PLEASE TEST IN OTHER PLACE THAT USE THIS HELPER FIRST AFTER MAKE CHANGES HERE
*                   - all the below code still in testing -
*/
function loadDatable(reference, tableId, url, customColumn){

    let column = []
    let total = $(customColumn).length

    /*
        data : {
            width : default (20%),
            display : required
        }
    */
    $(customColumn).each(function(index, data){

        if (index === total - 1 && tableId != '#table-kawalan-sistem') {
            column.push({
                "aTargets": [index],
                "width": data.width ? data.width : '20%',
                "className": data.className ?? 'text-left',
                "mData": data.display,
                "mRender": function (data, type, full )  {

                    let button_a = '<button type="button" class="btn btn-icon text-dark" title="Edit" id="edit-'+reference+'" data-id="'+data+'"><i class="fa fa-edit"></i></button>'
                    let button_b = '<button type="button" class="btn btn-icon js-sweetalert" title="Delete" id="delete-'+reference+'" data-id="'+data+'" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>'
                    return button_a + '|' +  button_b
                }
            })
        } else {
            column.push({
                "aTargets": [index],
                "width": data.width ? data.width : '20%',
                "className": data.className ?? 'text-left',
                "mData": data.display == ('updated_at' || 'created_at') 
                    ?   moment(data.display).format("Do MMMM YYYY") 
                    :   data.display,
                "mRender": function(data, type, full) {
                    let value = ''

                    if(Array.isArray(data) && data.length != 0){
                        $.each(data, function(index, data) {

                            value += data.name+ '<br>'
                           
                        });
                        return value
                       
                    }else{
                        return data
                    }
                }
                
            })
        }   
    })

    $(tableId).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {url: url},
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
        
        "aoColumnDefs": column,
        "order": [[ 0, 'asc' ]],
        initComplete: function () {
            $('#btn-save-'+reference+'').html("Simpan")
        }
    })
}

function clearModal(modalId){

    $(modalId).on('hidden.bs.modal', function (e) {
        
        e.preventDefault()
        $(this).find("input,textarea,select").val('').end()
               .find("input[type=checkbox], input[type=radio]").prop("checked", "").end()
               .find("input,textarea,select").prop("readonly", false).end()
               .find("input,textarea,select").prop("disabled", false).end()
               .find("input,textarea,select").removeClass('is-invalid').end()

        $(this).find('form').trigger('reset')
        
        if(modalId == '#modal-pengguna'){
            $(".select_sekolah_pengguna").css("display", "none"),
            $("#select_sekolah_pengguna").val(""),
            $(".select_negeri_pengguna").css("display", "none"),
            $("#select_negeri_pengguna").val("")
        }
       
    })
}

function ajaxForm(data){
    
    $.ajax({
        type:    data.type,
        url:     data.url,
        data:    data.form, // serializes the form's elements.
                contentType:    false,
                processData:    false,
                cache:          false,
                // xhr: function(){
                //     //upload Progress
                //     var xhr = $.ajaxSettings.xhr();
                //     if (xhr.upload) {
                //         xhr.upload.addEventListener('progress', function(event) {
                //             var percent = 0;
                //             var position = event.loaded || event.position;
                //             var total = event.total;
                //             if (event.lengthComputable) {
                //                 percent = Math.ceil(position / total * 100);
                //             }
                //             //update progressbar
                //             $("#upload-progress .progress-bar").css("width", + percent +"%");
                //         }, true);
                //     }
                //     return xhr;
                // },
        success: function(data)
        {
            notify()
            setTimeout(() => {
                window.location.reload()
            }, 2000);
        },
        error: function(err){

            $.each(err.responseJSON.errors, function(index, res){

                if(data.base && data.base == 'kawalan-sistem'){

                    $('#'+index+'_kawalan_sistem').addClass('is-invalid')
                    $('.c_'+index+'_kawalan_sistem').html(res)

                } else {

                    $('#'+index).addClass('is-invalid')
                    $('.c_'+index).html(res)
                }
               
            })
        }
    });

    function notify(){
        return $.notify({
            title:'Successfull: ' + data.title,
            message: data.message
         },
         {
            type:'success',
            allow_dismiss:true,
            newest_on_top:false ,
            mouse_over:true,
            showProgressbar:false,
            spacing:10,
            timer:2000,
            placement:{
              from:'top',
              align:'right'
            },
            offset:{
              x:30,
              y:30
            },
            delay:1000 ,
            z_index:10000,
            animate:{
              enter:'animated fadeIn',
              exit:'animated bounce'
          }
        });
    }
}

function sweetalert(id, data){
    Swal.fire({

        title: "Anda pasti?",
        text: "Anda akan memadam rekod "+id+" dari pangkalan data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        confirmButtonText: "Ya, sila padam!",
        cancelButtonText: "Tidak",
        closeOnConfirm: false,
        closeOnCancel: false

    }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: data.url,
                success: function (data) {
                    
                    Swal.fire("Sudah dipadam!", "Rekod "+ id +" telah dipadam dari pangkalan data", "success")
                    .then(function(){ 
                        location.reload();
                    });
                },
                error: function (err) {
                    console.error(err)
                }
            });

        } else {

            Swal.fire("Tidak", "Proses pemadaman tidak berlaku", "error");

        }
    });
}

async function getData(data){
    let res

    try {
        res = await $.ajax({
            url: data.url,
            type: 'GET',
            data: data.data ?? null,
            dataType: 'json',
        });
    } catch (e) {
        console.error('Error:' + e)
    }
   
    return res
}

export { 
    loadDatable,
    ajaxForm,
    clearModal,
    getData,
    sweetalert
}