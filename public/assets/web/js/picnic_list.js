$(document).ready(function () {

const tableColumns = [
    {
        title: "#",
        render: function (data, type, row, meta) {
            // to increment the index number continuously even in next pages
            return meta.row + meta.settings._iDisplayStart + 1;
        },
    },
    { title: "Title", data: "title" },
    { title: "Location", data: "location" },
    { title: "Date", data: "date" },
    { title: "Time", data: "time" },
    { title: "Description", data: "description" },
    { title: "Agenda", data: "agenda" },
    // { title: "Action", data: "action" },
    ,
];
const picnicTable = $('#picnic-list-table').DataTable({
    language: {
        "processing": "<i class='fa fa-refresh fa-spin'></i>",
        "emptyTable": "<div class='alert alert-info text-center'>No picnic found found</div>"
    },
    lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
    dom: 'lfBrtip',
    "order": [[ 0, "asc" ]], //set the default order on # column
    'columnDefs': [ 
        {
        'targets': [0,2,3], /* column indexes starts with 0 */
        'orderable': true, /* true or false - to configure sorting*/
        },
        {
        'targets': '_all', /* all columns except the 1st mentioned targets (otherwise all columns will be considered) */
        'orderable': false, /* true or false - to configure sorting*/
        "defaultContent": "-",
        },
    ],
    scrollX: true,
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": picnic_list,
        "dataType": "json",
        "type": "POST",
        "data": function (d) {
            return $.extend({}, d, {
                "_token": $('meta[name="csrf-token"]').attr("content"),
                
            });
        }
    },
    "columns": tableColumns
});

});
