$(function() {

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
        { title: "Title", data: "title" },
        { title: "Date", data: "date" },
        { title: "Created By", data: "author" },
        { title: "Status", data: "status" },
        { title: "Action", data: "action" },
    ];
    const picnicTable = $('#blog-table').DataTable({
        language: {
            "processing": "<i class='fa fa-refresh fa-spin'></i>",
            "emptyTable": "<div class='alert alert-info text-center'>No blog found found</div>"
        },
        lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
        dom: 'lfBrtip',
        "order": [[ 0, "desc" ]], //set the default order on # column
        'columnDefs': [
            {
            'targets': [0], /* column indexes starts with 0 */
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

                });
            }
        },
        "columns": tableColumns
    });

    /* Blog delete function start*/
    $(document).on("click", '.delete-btn', function(){
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.value) {
              var params = {
                'id' : $(this).attr('data-id')
              };
              $('#cover-spin').show();
              $.ajax({
                  type: "DELETE",
                  url: deleteUrl,
                  data: params,
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (output) {
                      $('#cover-spin').hide();
                      if (output.status == "success") {
                          Swal.fire({
                              title: "Deleted",
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
    });
    /* Blog delete function end*/

  } else if (page == 'addPage' || page == 'editPage') {
    $('#blog_form').validate({
      rules:{
        title: {
          required: true
        },
        description: {
          required: true
        },
      },
      messages: {
        title: {
          required: 'Enter Blog Title'
        },
        description: {
          required: 'Enter Blog Description'
        },
      },
      submitHandler:function(form, e) {
        $('#cover-spin').show();
        e.preventDefault();
        var formData = new FormData(form);
        $.ajax({
          type: "POST",
          url: saveUrl,
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          success:function(response) {
            $('#cover-spin').hide();
            if (response.status == 'success') {
              Swal.fire({
                  title: 'Success!',
                  text: response.message,
                  icon: 'success',
                  confirmButtonText: 'OK',
                  allowOutsideClick: false,
                  }).then((result) => {
                  if (result.value) {
                      window.location.replace(response.next);
                  }
              })
            } else {
              $.each(response.messages, function(key, val){
                //$("input[name='" + key + "']").parent().after('<label class="error">' +val[0]+'</label>');
                toastr.error('Error', val);
              });
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
      },
    });
  }

});
