<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Excel Tailor</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/order_form.css" rel="stylesheet">
    
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ) : ?>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"><span>Excel</span>Tailor</a>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <!-- <div class="profile-userpic">
                <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
            </div> -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"><?php echo $_SESSION['full_name']; ?></div>
                <!-- <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div> -->
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        <ul class="nav menu">
            <li <?php echo (CURRENT_PAGE =="dashboard.php") ? 'class="active"' : '' ; ?>><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'administrator' || $_SESSION['user_type'] == 'manager') ) : ?>
            <li <?php echo (CURRENT_PAGE =="customers.php" || CURRENT_PAGE =="add_customer.php") ? 'class="active"' : '' ; ?>><a href="customers.php"><em class="fa fa-users">&nbsp;</em> Customers</a></li>
            <li <?php echo (CURRENT_PAGE =="orders.php" || CURRENT_PAGE =="add_order.php") ? 'class="active"' : '' ; ?>><a href="orders.php"><em class="fa fa-shopping-cart">&nbsp;</em> Orders</a></li>
            <?php endif; ?>
            <li <?php echo (CURRENT_PAGE =="items.php") ? 'class="active"' : '' ; ?>><a href="items.php"><em class="fa fa-check-square">&nbsp;</em> Items</a></li>
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'administrator' ) : ?>
            <li <?php echo (CURRENT_PAGE =="employees.php") ? 'class="active"' : '' ; ?>><a href="employees.php"><em class="fa fa-user-circle-o">&nbsp;</em> Employees</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'administrator' ) : ?>
            <li <?php echo (CURRENT_PAGE =="reports.php") ? 'class="active"' : '' ; ?>><a href="reports.php"><em class="fa fa-file">&nbsp;</em> Reports</a></li>
            <?php endif; ?>
            <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div><!--/.sidebar-->
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <!-- <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active"><?php //echo CURRENT_PAGE; ?></li>
            </ol>
        </div> -->
        <!--/.row-->
        <?php endif; ?>