 <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ) : ?>
</div>	<!--/.main-->

<div id="toast" class="toast-message"><div id="img"><span class="glyphicon glyphicon-envelope"></span></div><div id="desc">Message Sent Successfully.</div></div>
<div id="toast-item" class="toast-message"><div id="img"><span class="glyphicon glyphicon-ok"></span></div><div id="desc">Status Updated Successfully.</div></div>

<?php endif; ?>
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

	<script>
		function launch_toast() {
			var x = document.getElementById("toast")
			x.className = "toast-message show";
			setTimeout(function(){ x.className = x.className.replace("toast-message show", "toast-message"); }, 5000);
		}

		function launch_toast_item() {
			var x = document.getElementById("toast-item")
			x.className = "toast-message show";
			setTimeout(function(){ x.className = x.className.replace("toast-message show", "toast-message"); }, 2000);
		}
	</script>

	<?php 
    if(strpos(CURRENT_PAGE, 'dashboard.php') !== FALSE)
		echo '<script src="js/chart-data.js"></script>';
	
    if(strpos(CURRENT_PAGE, 'orders.php') !== FALSE)
		echo '<script src="js/orders.js"></script>';
	
    if(strpos(CURRENT_PAGE, 'items.php') !== FALSE)
		echo '<script src="js/custom-item.js"></script>';

		if(strpos(CURRENT_PAGE, 'reports.php') !== FALSE)
		echo '<script src="js/reports.js"></script>';
	
    if(strpos(CURRENT_PAGE, 'add_order.php') !== FALSE)
      echo '<script src="js/order_form.js"></script>';
    elseif(strpos(CURRENT_PAGE, 'edit_order.php') !== FALSE)
      echo '<script src="js/order_form_edit.js"></script>';
    ?>
	
		
</body>
</html>