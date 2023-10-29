
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
        { title: "Location", data: "location" },
        { title: "Date", data: "date" },
        { title: "Agenda", data: "agenda" },
        { title: "Status", data: "status" },
        { title: "Action", data: "action" },
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

  } else if (page == 'addPage' || page == 'editPage') {

    datePicker(moment());

    if (id > 0) {
      datePicker(date);
    }

    function datePicker(start_time) {
        $('#date').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            autoUpdateInput: false,
            showDropdowns: false,
             locale: {
                format: 'MMMM D, YYYY, h:mm A'
            },
            startDate: start_time,
            minDate: moment().startOf('day'), // min date will be always today
        });

        $('#date').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MMMM D, YYYY, h:mm A'));
        });
    }

    // form submition start
    $('#picnic_form').validate({
      submitHandler:function(form, e) {
        var formData = new FormData(form);
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: saveUrl,
          data:formData,
          cache: false,
          contentType: false,
          processData: false,
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
                      window.location.replace(output.next);
                  }
              })
            } else {
              $.each(output.messages, function(key, val){
                // $("input[name='" + key + "']").parent().after('<label class="error">' +val[0]+'</label>');
                toastr.error('Error', val);
              });

            }
          }
        });
      },
    });
    //form submition end

  }

});
