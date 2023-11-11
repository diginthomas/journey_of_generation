$(function(){

  getPicnic();

  function getPicnic() {
    $.ajax({
      type: "POST",
      url: getPicnic,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success:function(response) {
        if (response.status == 'success') {
          console.log(response.picnics);
        } else {

        }
      },
      error:function() {
        console.log('Something went wrong!');
      },
    });
  }

});
