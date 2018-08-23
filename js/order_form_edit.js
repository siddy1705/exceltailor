$(document).ready(function () {

  var navListItems = $('div.setup-panel div a'),
      allWells = $('.setup-content'),
      allNextBtn = $('.nextBtn');
      allPrevBtn = $('.prevBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
          $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-success').addClass('btn-default');
          $item.addClass('btn-success');
          allWells.hide();
          $target.show();
          //$target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function () {
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='radio']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for (var i = 0; i < curInputs.length; i++) {
          if (!curInputs[i].validity.valid) {
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
      else $('#customer_not_selected').show();
  });

  allPrevBtn.click(function () {
    var curStep = $(this).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='radio']"),
        isValid = true;

        nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-success').trigger('click');

  $('#add_new_customer').hide();

  $( "#delivery-date" ).datepicker({
    format: "yyyy-mm-dd"
  });

  $('#delivery-date').on('changeDate', function(ev){
    $(this).datepicker('hide');
  });

  // Add and Display Measurments 
  $("#save_measurment").click(function(e) {
    var measurment_data = $('form#add_measurment').serializeArray();
    var custId = $('input[name=customer_id]:checked').val();
    console.log(measurment_data);
    console.log(custId);
      $.ajax({
        type: "POST",
        url: "add_measurment_ajax.php",
        dataType: "json",  
        data: {
          measurment_data: measurment_data,
          custId: custId
        },
        success: function(results) {
          console.log(results);
          if(results.length > 0) {
            $('#measurment-table > tr ').remove();
            //console.log(results);
            results.forEach(result => {
              $('#measurment-table').append('<tr class="measurment-info-'+ result.measurment_id +'">'
              + '<td valign="center"><input type="radio" name="measurment_id" value="'+ result.measurment_id +'" required></td>'
              + '<td valign="center">'+ result.measurment_name +'</td>'
              + '<td colspan="8">'
              + '<table style="width: 100%;" class="table table-striped table-bordered table-condensed"><thead>'
              + '<tr><th colspan="8">Upper Body</th></tr>'
              + '<tr><th>Length</th><th>Chest</th><th>Stomach</th><th>Hip</th>'
              + '<th>Shoulders</th><th>Sleeves</th><th>Sleeve Round</th><th>Neck</th></tr>'
              + '</thead>'
              + '<tbody><tr>'
              + '<td>'+ result.ub_length +'</td>'
              + '<td>'+ result.ub_chest +'</td>'
              + '<td>'+ result.ub_stomach +'</td>'
              + '<td>'+ result.ub_hip +'</td>'
              + '<td>'+ result.ub_shoulders +'</td>'
              + '<td>'+ result.ub_sleeves +'</td>'
              + '<td>'+ result.ub_sleeve_round +'</td>'
              + '<td>'+ result.ub_neck +'</td>'
              + '</tr></tbody></table>'
              + '<table style="width: 100%;" class="table table-striped table-bordered table-condensed"><thead>'
              + '<tr><th colspan="8">Lower Body</th></tr>'
              + '<tr><th>Length</th><th>Waist</th><th>Hip</th><th>Thigh</th>'
              + '<th>Knee</th><th>Bottom</th><th>Inside</th>'
              + '</thead>'
              + '<tbody><tr>'
              + '<td>'+ result.lb_length +'</td>'
              + '<td>'+ result.lb_waist +'</td>'
              + '<td>'+ result.lb_hip +'</td>'
              + '<td>'+ result.lb_thigh +'</td>'
              + '<td>'+ result.lb_knee +'</td>'
              + '<td>'+ result.lb_bottom +'</td>'
              + '<td>'+ result.lb_inside +'</td>'
              + '</tr></tbody></table>'
              + '</td></tr>')
            });     
          }
        },
        error: function(result, error) {
          console.log(error);
          
        }
      });
  });

  $('.order-buttons > a').attr("disabled","disabled");

  var orderStatus = $('#order-status').val();

  console.log("status: " + orderStatus);

  if(orderStatus == 'Completed') {
    $('.order-buttons > a').removeAttr("disabled");
  }

  $('#order-status').change(function (e){
    if($('#order-status').val() == 'Completed') 
    $('.order-buttons > a').removeAttr("disabled");
    else 
    $('.order-buttons > a').attr("disabled","disabled");
  })

  $('#print-receipt').click(function(e){
    
    var orderId = $('#order-id').val();
    var customerName = $('td#name').html();
    var orderTitle = $('#order-title').val();
    var totalAmount = $('#total-amount').val();
    var orderStatus = $('#order-status :selected').val();

    var fileExists = doesFileExist('receipts/excel-' + orderId + '.pdf');
    console.log('file exists: ' + fileExists);
    if(orderStatus == 'Completed') {
      if(fileExists) {
        var win = window.open('receipts/excel-' + orderId + '.pdf', '_blank');
        win.focus();
      }
      else {
        $.ajax({
          type: "POST",
          url: "print_receipt_ajax.php",
          dataType: "json",  
          data: {
            orderId: orderId,
            customerName: customerName,
            orderTitle: orderTitle,
            totalAmount: totalAmount
          },
          success: function(results) {
            console.log(results);
            var win = window.open(results, '_blank');
            win.focus();
          },
          error: function(result, error) {
            console.log(error);    
          }
        });
      }
    }
  })

});

function doesFileExist(urlToFile) {
      var xhr = new XMLHttpRequest();
      xhr.open('HEAD', urlToFile, false);
      xhr.send();
       
      if (xhr.status == "404") {
          return false;
      } else {
          return true;
      }
  }