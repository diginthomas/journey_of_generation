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
                            moment(val.date).format("MMMM D, YYYY")+
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

});
