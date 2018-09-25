$(document).ready(function () { 
	$('.send-sms').click(function(e){
    e.preventDefault();

    var phoneNumber = $(this).attr("id");;
    var pendingAmount = $('td#pending-amount').html();
    
    var message = 'Dear customer, your order at Excel Tailors has been completed. Please pay the pending amount of Rs.' + pendingAmount + ' and collect your order within 2-3 days. Thanks';

    $.ajax({
      type: "POST",
      url: "send-sms-ajax.php",
      data: {
        number: phoneNumber,
        message: message
      },
      success: function(results) {
        console.log(results);
        launch_toast();
        //console.log('message: ' + message);
      },
      error: function(error) {
        console.log(error);    
      }
    });
  })

  $( "#delivery-date" ).datepicker({
    format: "yyyy-mm-dd"
  });

  $('#delivery-date').on('changeDate', function(ev){
    $(this).datepicker('hide');
  });
})