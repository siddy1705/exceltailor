 <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ) : ?>
</div>	<!--/.main-->

<?php endif; ?>
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

	<?php 
    if(CURRENT_PAGE == 'dashboard.php')
		echo '<script src="js/chart-data.js"></script>';
	?>
  	
	<?php 
    if(CURRENT_PAGE == 'add_order.php')
        echo '<script src="js/order_form.js"></script>';
    elseif(strpos(CURRENT_PAGE, 'edit_order.php') !== FALSE)
        echo '<script src="js/order_form_edit.js"></script>';
    ?>
	
		
</body>
</html>