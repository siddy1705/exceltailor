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
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for (var i = 0; i < curInputs.length; i++) {
          if (!curInputs[i].validity.valid) {
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-success').trigger('click');

  $('#add_new_customer').hide();

  $( "#delivery-date" ).datepicker();

  $('#delivery-date').on('changeDate', function(ev){
    $(this).datepicker('hide');
  });

  // Get Customers from Mobile Number
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
        success: function(result) {
          if(result != null) {
            //$('#cust_info > td').remove();
            $('#add_new_customer').hide();
            $('#customer-fetch').show();
            $('#cust_id').val(result.id);
            $('#name').html(result.f_name + " " + result.l_name);
            $('#gender').html(result.gender);
            $('#phone').html(result.phone);

          }
        },
        error: function(result, error) {
          console.log(error);
          $('#customer-fetch').hide();
          $('#add_new_customer').show();
        }
      });
    }
  });


  // Get Measurment Details
  $("#order-form-step2").click(function(e) {
    var custId = $('#cust_id').val();
    console.log(custId)
      $.ajax({
        type: "POST",
        url: "get_measurments_ajax.php",
        dataType: "json",  
        data: {
          cust_id: custId,
        },
        success: function(results) {
          if(results != null) {
            //var res = JSON.parse(result)
            console.log(results);
            results.forEach(result => {
              $('#measurment-table').append('<tr class="measurment-info-'+ result.measurment_id +'">'
              + '<td><input type="radio" name="measurment-select" value="'+ result.measurment_id +'"></td>'
              + '<td>'+ result.name +'</td>'
              + '<td>'+ result.ub_a +'</td>'
              + '<td>'+ result.ub_b +'</td>'
              + '<td>'+ result.lb_a +'</td>'
              + '<td>'+ result.lb_b +'</td>'
              + '</tr>');
            });
          }
        },
        error: function(result, error) {
          console.log(error);
          $('#add_new_customer').show();
        }
      });
  });

});