$(document).ready(function () {

  var navListItems = $('div.setup-panel div a'),
      allWells = $('.setup-content'),
      allNextBtn = $('.nextBtn');

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

  $('div.setup-panel div a.btn-success').trigger('click');

  $('#add_new_customer').hide();

  $( "#delivery-date" ).datepicker();

  $('#delivery-date').on('changeDate', function(ev){
    $(this).datepicker('hide');
  });

  // Get Customers from Mobile Number & Name
  $("#get-customers").click(function(e) {
    if($("#phone-number").val() != ''){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "get_customers_ajax.php",
        dataType: "json",  
        data: {
          phone:  $("#phone-number").val(),
        },
        success: function(results) {
          //console.log(results);
          $('#customer_not_selected').hide();
          if(results.length > 0) {
            $('#cust_info ').remove();
            $('#customer-table > tr ').remove();
            $('#add_new_customer').hide();
            $('#customer-fetch').show();
            
            results.forEach(result => {
              $('#customer-table').append('<tr class="customer-info-'+ result.id +'">'
              + '<td><input type="radio" name="customer_id" value="'+ result.id +'" required></td>'
              + '<td>'+ result.f_name + ' ' + result.l_name +'</td>'
              + '<td>'+ result.gender +'</td>'
              + '<td>'+ result.phone +'</td>'
              + '</tr>');
            });

          }
          else {
            $('#customer-fetch').hide();
            $('#add_new_customer').show();
          }
        }
      });
    }
  });


  // Get Measurment Details
  $("#order-form-step2").click(function(e) {
    var custId = $('input[name=customer_id]:checked').val();
    console.log(custId)
      $.ajax({
        type: "POST",
        url: "get_measurments_ajax.php",
        dataType: "json",  
        data: {
          cust_id: custId,
        },
        success: function(results) {
          //console.log(results);
          if(results.length > 0) {
            //console.log(results);
            $('#measurment-table > tr ').remove();
            results.forEach(result => {
              $('#measurment-table').append('<tr class="measurment-info-'+ result.measurment_id +'">'
              + '<td><input type="radio" name="measurment_id" value="'+ result.measurment_id +'"></td>'
              + '<td>'+ result.measurment_name +'</td>'
              + '<td>'+ result.ub_length +'</td>'
              + '<td>'+ result.ub_chest +'</td>'
              + '<td>'+ result.ub_stomach +'</td>'
              + '<td>'+ result.ub_hip +'</td>'
              + '<td>'+ result.ub_shoulders +'</td>'
              + '<td>'+ result.ub_sleeves +'</td>'
              + '<td>'+ result.ub_sleeve_round +'</td>'
              + '<td>'+ result.ub_neck +'</td>'
              + '<td>'+ result.lb_length +'</td>'
              + '<td>'+ result.lb_waist +'</td>'
              + '<td>'+ result.lb_hip +'</td>'
              + '<td>'+ result.lb_thigh +'</td>'
              + '<td>'+ result.lb_knee +'</td>'
              + '<td>'+ result.lb_bottom +'</td>'
              + '<td>'+ result.lb_inside +'</td>'
              + '</tr>');
            });
          }
        },
        error: function(result, error) {
          console.log(error);
          
        }
      });
  });

  // Add and Display Measurments 
  $("#save_measurment").click(function(e) {
    var measurment_data = $('form#add_measurment').serializeArray();
    var custId = $('input[name=customer_id]:checked').val();
    //console.log(measurment_data);
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
            console.log(results);
            results.forEach(result => {
              $('#measurment-table').append('<tr class="measurment-info-'+ result.measurment_id +'">'
              + '<td><input type="radio" name="measurment_id" value="'+ result.measurment_id +'"></td>'
              + '<td>'+ result.measurment_name +'</td>'
              + '<td>'+ result.ub_length +'</td>'
              + '<td>'+ result.ub_chest +'</td>'
              + '<td>'+ result.ub_stomach +'</td>'
              + '<td>'+ result.ub_hip +'</td>'
              + '<td>'+ result.ub_shoulders +'</td>'
              + '<td>'+ result.ub_sleeves +'</td>'
              + '<td>'+ result.ub_sleeve_round +'</td>'
              + '<td>'+ result.ub_neck +'</td>'
              + '<td>'+ result.lb_length +'</td>'
              + '<td>'+ result.lb_waist +'</td>'
              + '<td>'+ result.lb_hip +'</td>'
              + '<td>'+ result.lb_thigh +'</td>'
              + '<td>'+ result.lb_knee +'</td>'
              + '<td>'+ result.lb_bottom +'</td>'
              + '<td>'+ result.lb_inside +'</td>'
              + '</tr>');
            });
            
          }
        },
        error: function(result, error) {
          console.log(error);
          
        }
      });
  });

});