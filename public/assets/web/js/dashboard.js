$(function(){

  getPicnic();

  function getPicnic() {
    $.ajax({
      type: "POST",
      url: getPicnicURL,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success:function(response) {

        var picnicTableHtml = '';

        picnicTableHtml = '<div class="col-12">'+
          '<div class="card table-card">'+
            '<div class="card-header">'+
              '<h4>'+
              'Upcoming Picnics'+
              '</h4>'+
            '</div>'+
            '<div class="card-body">'+
              '<div class="table-responsive">'+
                '<table class="table">'+
                  '<thead>'+
                    '<tr>'+
                      '<th>'+
                        '#'+
                      '</th>'+
                      '<th>'+
                        'Title'+
                      '</th>'+
                      '<th>'+
                        'Location'+
                      '</th>'+
                      '<th>'+
                        'Date'+
                      '</th>'+
                      '<th>'+
                        'Action'+
                      '</th>'+
                    '</tr>'+
                  '</thead>'+
                  '<tbody>';
                    if (response.picnics.length > 0 && response.picnics != undefined) {
                      var i = 1;
                      $.each(response.picnics, function(key, val){
                        picnicTableHtml += '<tr>'+
                          '<td>';
                            picnicTableHtml += i++;
                          picnicTableHtml += '</td>'+
                          '<td>'+
                            val.title+
                          '</td>'+
                          '<td>'+
                            val.location+
                          '</td>'+
                          '<td>'+
                            moment(val.date).format("MMM D, YYYY")+
                          '</td>'+
                          '<td>'+
                            '<a href="javascript:void(0)" class="view-picnic" data-id="'+val.id+'" title="View">'+
                              '<i class="far fa-eye"></i>'+
                            '</a>'+
                          '</td>'+
                        '</tr>';
                      });
                    } else {
                      picnicTableHtml += '<tr>'+
                        '<td>'+
                          'No picnic found!'
                        '</td>'+
                      '</tr>';
                    }
                  picnicTableHtml += '</tbody>'+
                '</table>'+
              '</div>'+
            '</div>'+
          '</div>'+
        '</div>';

        $('.picnic-table').html(picnicTableHtml);
      },
      error:function() {
        console.log('Something went wrong!');
      },
    });
  }

  $(document).on('click', '.view-picnic', function(e){
    e.preventDefault();
    var url = viewPicnicURL + '/' + $(this).attr('data-id');
    window.open(url);
  });

});
