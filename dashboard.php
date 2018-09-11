<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();

//Get Dashboard information
$numCustomers = $db->getValue ("et_customers", "count(*)");

$total_orders = $db->getValue("et_orders", "count(*)");

$db->where('order_status', 'Completed');
$completed_orders = $db->getValue ("et_orders", "count(*)");

$db->where('order_status', 'Processing');
$processing_orders = $db->getValue ("et_orders", "count(*)");

$d = new DateTime();
$today = $d->format('Y-m-d');

$db->where("created_at", $today . " 00:00:00", ">");
$db->where("created_at", $today . " 23:59:59", "<");
$received_today = $db->getValue("et_orders", "count(*)");

$db->where("order_status", "Pending");
$pending_orders = $db->getValue("et_orders", "count(*)");

$db->where("delivery_date", $today);
$due_today = $db->getValue("et_orders", "count(*)");

include_once('includes/header.php');
?>
<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><a href="#" class="dashboard-stats" id="total"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large"><?php echo $total_orders; ?></div>
							<div class="text-muted">Total Orders</div></a>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><a href="#" class="dashboard-stats" id="created_today"><em class="fa fa-xl fa-calendar-check-o color-orange"></em>
							<div class="large"><?php echo $received_today; ?></div>
							<div class="text-muted">Orders Received Today</div></a>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget border-right">
						<div class="row no-padding"><a href="#" class="dashboard-stats" id="pending"><em class="fa fa-xl fa-refresh color-red"></em>
							<div class="large"><?php echo $pending_orders; ?></div>
							<div class="text-muted">Pending Orders</div></a>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget ">
						<div class="row no-padding"><a href="#" class="dashboard-stats" id="due_today"><em class="fa fa-xl fa-clock-o color-teal"></em>
							<div class="large"><?php echo $due_today; ?></div>
							<div class="text-muted">Delivery Due Today</div></a>
						</div>
					</div>
				</div>
			</div><!--/.row-->

			
		</div>
		<div class="row" id="orders-bar-graph" style="display:none;">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span id="order-graph-heading" class="order-graph-heading">Orders Graph</span>
						<span id="orders-bar-graph-close" class="pull-right graph-panel-toggle panel-button-tab-left"><em class="fa fa-times"></em></span>
					</div>
					<div class="panel-body">
						<div class="canvas-wrapper" id="orders-details-barchart">
							<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Orders Overview
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<!-- <div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>New Orders</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Comments</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>New Users</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Visitors</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span></div>
					</div>
				</div>
			</div>
		</div> --><!--/.row-->
			<div class="col-sm-12">
				<p class="back-link">Excel Tailor - <?php echo date('Y'); ?></p>
			</div>
		</div><!--/.row-->

<?php include_once('includes/footer.php'); ?>
