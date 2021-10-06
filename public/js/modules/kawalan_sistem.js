import * as Helper from '../helper.js'

/*
*   INIT DATATABLE
*/
Helper.loadDatable(
    kawalan_sistem.table.name,
    '#table-kawalan-sistem',
    kawalan_sistem.route.datatable_url,
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
            display: 'sub_permissions'
        }
    ]
)