$(document).ready(function () {
  $('select.item-status').on('change', function() {
    console.log("hello");
    var itemId = $(this).attr("id");
    var itemStatus = (this.value);

    $.ajax({
      type: "POST",
      url: "edit_item_status_ajax.php",
      dataType: "json",  
      data: {
        itemId: itemId,
        itemStatus: itemStatus
      },
      success: function(results) {
        console.log(results);
        launch_toast_item();
      },
      error: function(error) {
        console.log(error);    
      }
    })

  });
})