 <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ) : ?>
</div>	<!--/.main-->

<div id="toast"><div id="img"><span class="glyphicon glyphicon-envelope"></span></div><div id="desc">Message Sent Successfully.</div></div>

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
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
		}
	</script>

	<?php 
    if(CURRENT_PAGE == 'dashboard.php')
		echo '<script src="js/chart-data.js"></script>';
	?>

	<?php 
    if(CURRENT_PAGE == 'orders.php')
		echo '<script src="js/orders.js"></script>';
	?>

	<?php 
    if(CURRENT_PAGE == 'items.php')
		echo '<script src="js/custom-item.js"></script>';
	?>
  	
	<?php 
    if(CURRENT_PAGE == 'add_order.php')
        echo '<script src="js/order_form.js"></script>';
    elseif(strpos(CURRENT_PAGE, 'edit_order.php') !== FALSE)
        echo '<script src="js/order_form_edit.js"></script>';
    ?>
	
		
</body>
</html>