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
          console.log(results);
          $('#customer_not_selected').hide();
          if(results.length > 0) {
            $('#cust_info ').remove();
            $('#customer-table > tr ').remove();
            $('#add_new_customer').hide();
            $('#customer-fetch').show();
            
            results.forEach(result => {
              $('#customer-table').append('<tr class="customer-info-'+ result.customer_id +'">'
              + '<td><input type="radio" name="customer_id" value="'+ result.customer_id +'" required></td>'
              + '<td>'+ result.f_name + ' ' + result.l_name +'</td>'
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
              + '</tr>'
              + '<tr><th colspan="8">Comments</th></tr>'
              + '<tr><td colspan="8">' + result.ub_comments + '</td></tr>'
              + '</tbody></table>'
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
              + '</tr>'
              + '<tr><th colspan="8">Comments</th></tr>'
              + '<tr><td colspan="8">' + result.lb_comments + '</td></tr>'
              + '</tbody></table>'
              + '</td></tr>')
            })
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
              + '</tr>'
              + '<tr><th colspan="8">Comments</th></tr>'
              + '<tr><td colspan="8">' + result.ub_comments + '</td></tr>'
              + '</tbody></table>'
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
              + '</tr>'
              + '<tr><th colspan="8">Comments</th></tr>'
              + '<tr><td colspan="8">' + result.lb_comments + '</td></tr>'
              + '</tbody></table>'
              + '</td></tr>')
            });
            
          }
        },
        error: function(result, error) {
          console.log(error);
          
        }
      });
  });

  var typeArr = [];
  var quantityArr = [];
  var assignedToArr = [];
  var rateArr = [];
  var titleArr = [];
  var descriptionArr = []
  var amountArr = [];
  var itemArr = [];
  var deleteMarker = 0;
  //var totalAmount;

  $('#save-item').click(function(){
    var tempItemArr = [];

    tempItemArr.push($('#order-type').val());
    tempItemArr.push($('#item-quantity').val());
    tempItemArr.push($('#assigned-to').val());
    tempItemArr.push($('#item-rate').val());
    tempItemArr.push($('#item-title').val());
    tempItemArr.push($('#item-desc').val());
    tempItemArr.push($('#item-rate').val() * $('#item-quantity').val())
    amountArr.push($('#item-rate').val() * $('#item-quantity').val())

    itemArr.push(tempItemArr);

    $('#item-list').append('<tr id="' + deleteMarker + '">'
    + '<td>' + $('#order-type').val() + '</td>'
    + '<td>' + $('#item-quantity').val() + '</td>'
    + '<td>' + $('#assigned-to').val() + '</td>'
    + '<td>' + $('#item-title').val() + '</td>'
    + '<td>' + $('#item-rate').val() * $('#item-quantity').val() + '</td>'
    + '<td><button class="btn btn-danger delete-item" type="button" id="' + deleteMarker + '"><span class="glyphicon glyphicon-remove"></span></button></td>'
    + '</tr>');

    deleteMarker++;

   $('.add-item-panel input[type=text], input[type=number], textarea').val("");
    
    console.log(itemArr);
  })

  $('#item-list').on("click", ".delete-item", function(e){
    // console.log("delete clicked")
    e.preventDefault();
    var id = $(this).attr("id");
    delete itemArr[id];
    delete amountArr[id];
    console.log(itemArr.filter(function(v){return v!== undefined}));
    $('tr#' + id).remove();
  });

  $('.tempBtn').click(function(){
    //console.log(typeArr);
    var totalAmount = 0;
    var itemArrNew = itemArr.filter(function(v){return v!== undefined});
    var amountArrNew = amountArr.filter(function(v){return v!== undefined});
    amountArrNew.forEach(function(amount){
      totalAmount = totalAmount + amount; 
    })
    $('#total-amount').val(totalAmount);
    $.ajax({
      type: "POST",
      url: "save_item_ajax.php",
      dataType: "json",  
      data: {
        itemArr: itemArrNew
      },
      success: function(results) {
        console.log(results);
      }
    })
  })

});