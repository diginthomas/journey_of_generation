
$(function() {
  
    $('.status-filter').select2();
    var rowId = '';
    if (page == 'listPage') {
  
      const tableColumns = [
          {
              title: "#",
              render: function (data, type, row, meta) {
                  // to increment the index number continuously even in next pages
                  return meta.row + meta.settings._iDisplayStart + 1;
              },
          },
          { title: "Name", data: "name" },
          { title: "Message", data: "message" },
          { title: "Date", data: "date" },
          { title: "Status", data: "status" },
          { title: "Action", data: "action" },
      ];
      const assistTable = $('#picnic-list-table').DataTable({
          language: {
              "processing": "<i class='fa fa-refresh fa-spin'></i>",
              "emptyTable": "<div class='alert alert-info text-center'>No Seniors  found</div>"
          },
          lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
          dom: 'lfBrtip',
          "order": [[ 0, "asc" ]], //set the default order on # column
          'columnDefs': [
              {
              'targets': [0,1], /* column indexes starts with 0 */
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
              "url": listUrl,
              "dataType": "json",
              "type": "POST",
              "data": function (d) {
                  return $.extend({}, d, {
                      "_token": $('meta[name="csrf-token"]').attr("content"),
                      'status':$('.status-filter').val()
                  });
              }
          },
          "columns": tableColumns
      });
  
      $(document).on("click", '.reject-btn', function(){
         actionRequest('Yes, reject it!','Rejected',3,$(this).attr('data-id'));
      });
      $(document).on("click", '.approve-btn', function(){
        actionRequest('Yes, approve it!','Approved',2,$(this).attr('data-id'));
     });
   
     $(document).on('select2:select', '.status-filter', function() {
        console.log('clicked');
        assistTable.ajax.reload();
      });

      function actionRequest(confirmButtonText,title,status,id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText,
        }).then((result) => {
            if (result.value) {
                var params = {
                  'id' : id,
                  'status':status
                };
                $.ajax({
                    type: "POST",
                    url: statusUrl,
                    data: params,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (output) {
                        if (output.status == "success") {
                            Swal.fire({
                                title: title,
                                text: output.message,
                                type: "success",
                                icon: "success"
                            }).then(function () {
                                picnicTable.row(rowId).invalidate().draw(false);
                            });
                        } else {
                            Swal.fire({
                                title: "Sorry!",
                                text: "Something went wrong",
                                type: "error",
                                icon: 'error'
                            })
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            title: "Sorry!",
                            text: "Something went wrong",
                            type: "error",
                            icon: 'error'
                        })
                    }
                });
            }
        })
      }
  
    } 
  
  });
  