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
        { title: "Quote", data: "quote" },
        { title: "Published On", data: "published_on" },
        { title: "Action", data: "action" },
    ];
    const quoteTable = $('#quote-list-table').DataTable({
        language: {
            "processing": "<i class='fa fa-refresh fa-spin'></i>",
            "emptyTable": "<div class='alert alert-info text-center'>No quote found</div>"
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
              $.ajax({
                  type: "POST",
                  url: deleteUrl,
                  data: params,
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (output) {
                      if (output.status == "success") {
                          Swal.fire({
                              title: "Deleted",
                              text: output.message,
                              type: "success",
                              icon: "success"
                          }).then(function () {
                            quoteTable.row(rowId).invalidate().draw(false);
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

    $("#animateModal").modal({
        backdrop: "static",
        keyboard: false,
    });
    $('#quote').val('');
    $('#id').val('');


    function saveQuote(quote,id){
        $.ajax({
            type: "POST",
            url: saveUrl,
            data:JSON.stringify({'quote':quote,'id':id}),
            cache: false,
            processData: false,
            contentType: 'application/json',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success:function(output) {
              if (output.status == 'success') {
                Swal.fire({
                    title: 'Success!',
                    text: output.message,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    }).then((result) => {
                    if (result.value) {
                        $('#quote').val('');
                        $('#id').val('');
                        quoteTable.ajax.reload();
                    }
                })
              } else {
                $.each(output.messages, function(key, val){
                  toastr.error('Error', val);
                });

              }
            }
          });
    }

    $( "#submit-quote" ).on( "click", function() {
        //  $('#animateModal').modal('hide');
            var quote = $('#quote').val();
            var id = $('#id').val();
            if(quote != ""){
                $('#animateModal').modal('toggle');
                saveQuote(quote,id);
            }else{
                toastr.error('Error', 'Quote is required');
            }

      });
      $('.add-btn').click(function(){
        $('.modal-title').html('Add New Quote');
      });
      $(document).on("click", '.edit', function(){
          $('.modal-title').html('Edit Quote')
           $.ajax({
            type: "POST",
            url: editUrl,
            data:JSON.stringify({'id': $(this).attr('data-id')}),
            cache: false,
            processData: false,
            contentType: 'application/json',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success:function(output) {
              if (output.quote != '') {
                $('#quote').val(output.quote);
                $('#id').val(output.id);

              } else {
                $.each(output.messages, function(key, val){
                  toastr.error('Error', 'Please try again');
                  $('#quote').val('');
                  $('#id').val('');
                });

              }
            },
            error: function (data) {
                toastr.error('Error', 'Please try again');
                $('#quote').val('');
                $('#id').val('');
            },
          });
        $('#animateModal').modal('toggle');
      });

    //this function is used for reset modal values when it close
    $(document).on("click", '#close-quite-modal', function(){
        $('#quote').val('');
        $('#id').val('');
    });
  }

});
