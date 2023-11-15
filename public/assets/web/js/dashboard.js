$(function(){

  getChartData();

  function getChartData() {
    $.ajax({
      type: "POST",
      url: charURL,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success:function(output) {
        if (output.status == 'success') {

          var totalSeniors = output.totalSeniors;
          var totalVolunteers = output.totalVolunteers;

          Highcharts.chart('chart-data', {
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Picnics joins of ' +output.currentYear,
                  align: 'center'
              },
              xAxis: {
                  categories: [
                      'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                  ],
                  crosshair: true,
                  accessibility: {
                      description: 'Month'
                  }
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Total Join'
                  }
              },
              tooltip: {
                  crosshairs: true,
                  shared: true
              },

              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              series: [
                {
                   name: 'Seniors',
                   data: totalSeniors
                },
                {
                   name: 'Volunteers',
                   data: totalVolunteers
                },
              ]
          });
        } else {
          $('#chart-data').html(output.errorHtml);
        }
      },
      error:function(error) {
        console.log('Something went wrong!');
      }
    });
  }

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
                        '<td class="dashboard-error-heading">'+
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
