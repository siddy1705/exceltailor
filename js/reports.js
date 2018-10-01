$(document).ready(function () { 

  $( ".reports-date" ).datepicker({
    format: "yyyy-mm-dd"
  });

  $('.reports-date').on('changeDate', function(ev){
    $(this).datepicker('hide');
  });
})