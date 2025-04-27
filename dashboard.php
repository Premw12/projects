<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Dashboard</title>
    <link href="vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    
	
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hk-row">
                        <?php
$query = mysqli_query($con, "select id from tblcategory");
$listedcat = mysqli_num_rows($query);
?>

<div class="col-lg-3 col-md-6">
    <div class="card shadow-lg border-0 bg-gradient-info text-white">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold text-uppercase">Categories</h6>
                </div>
                <div>
                    <i class="fas fa-th-list fa-2x"></i> <!-- Category Icon -->
                </div>
            </div>
            <div class="text-center">
                <h2 class="fw-bold display-5 counter-anim"><?php echo $listedcat; ?></h2>
                <small class="text-white-50">Listed Categories</small>
            </div>
        </div>
    </div>
</div>




<?php
$query = mysqli_query($con, "select id from tblcompany");
$listedcomp = mysqli_num_rows($query);
?>
<div class="col-lg-3 col-md-6">
    
    <div class="card shadow-lg border-0 bg-gradient-primary text-white"    >
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold text-uppercase">Companies</h6>
                </div>
                <div>
                    <i class="fas fa-building fa-2x"></i> <!-- Company Icon -->
                </div>
            </div>
            <div class="text-center">
                <h2 class="fw-bold display-5 counter-anim"><?php echo $listedcomp; ?></h2>
                <small class="text-white-50">Listed Companies</small>
            </div>
        </div>
    </div>
</div>



<?php
$query = mysqli_query($con, "select id from tblproducts");
$listedprod = mysqli_num_rows($query);
?>
<div class="col-lg-3 col-md-6">
    <div class="card shadow-lg border-0 bg-gradient-info text-white">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold text-uppercase">Products</h6>
                </div>
                <div>
                    <i class="fas fa-building fa-2x"></i> <!-- Product Icon -->
                </div>
            </div>
            <div class="text-center">
                <h2 class="fw-bold display-5 counter-anim"><?php echo $listedprod; ?></h2>
                <small class="text-white-50">Listed Products</small>
            </div>
        </div>
    </div>
</div>



<?php
$query = mysqli_query($con, "SELECT SUM(tblorders.Quantity * tblproducts.ProductPrice) AS totalSales FROM tblorders JOIN tblproducts ON tblproducts.id = tblorders.ProductId");
$row = mysqli_fetch_array($query);
$totalSales = $row['totalSales'] ? $row['totalSales'] : 0; // Handle NULL case
?>
<div class="col-lg-3 col-md-6">
    <div class="card shadow-lg border-0 bg-gradient-primary text-white"   >
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold text-uppercase">Total Sales</h6>
                </div>
                <div>
                    <i class="fas fa-building fa-2x"></i> <!-- Total Sales Icon -->
                </div>
            </div>
            <div class="text-center">
                <h2 class="fw-bold display-5 counter-anim"><?php echo number_format($totalSales, 2); ?></h2>
                <small class="text-white-50">Total Revenue Earned</small>
            </div>
        </div>
    </div>
</div>
<?php
$qury = mysqli_query($con, "SELECT SUM(tblorders.Quantity * tblproducts.ProductPrice) AS last7daysSales 
                            FROM tblorders 
                            JOIN tblproducts ON tblproducts.id = tblorders.ProductId 
                            WHERE DATE(tblorders.InvoiceGenDate) >= DATE(NOW()) - INTERVAL 7 DAY");
$row = mysqli_fetch_array($qury);
$last7daysSales = $row['last7daysSales'] ? $row['last7daysSales'] : 0; // Handle NULL case
?>
<div class="col-lg-3 col-md-6">
    <div class="card shadow-lg border-0 bg-gradient-info text-white"    >
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold text-uppercase">Last 7 Days Sales</h6>
                </div>
                <div>
                    <i class="fas fa-building fa-2x"></i> <!-- Last 7 Days Sales Icon -->
                </div>
            </div>
            <div class="text-center">
                <h2 class="fw-bold display-5 counter-anim"><?php echo number_format($last7daysSales, 2); ?></h2>
                <small class="text-white-50">Total Sales in Last 7 Days</small>
            </div>
        </div>
    </div>
</div>
<?php
$qurys = mysqli_query($con, "SELECT SUM(tblorders.Quantity * tblproducts.ProductPrice) AS yesterdaySales 
                            FROM tblorders 
                            JOIN tblproducts ON tblproducts.id = tblorders.ProductId 
                            WHERE DATE(tblorders.InvoiceGenDate) = CURDATE() - INTERVAL 1 DAY");
$rw = mysqli_fetch_array($qurys);
$yesterdaySales = $rw['yesterdaySales'] ? $rw['yesterdaySales'] : 0; // Handle NULL case
?>
<div class="col-lg-3 col-md-6">
    <div class="card shadow-lg border-0 bg-gradient-primary text-white">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold text-uppercase">Yesterday Sales</h6>
                </div>
                <div>
                    <i class="fas fa-building fa-2x"></i> <!-- Calendar Icon -->
                </div>
            </div>
            <div class="text-center">
                <h2 class="fw-bold display-5 counter-anim"><?php echo number_format($yesterdaySales, 2); ?></h2>
                <small class="text-white-50">Total Sales from Yesterday</small>
            </div>
        </div>
    </div>
</div>
<?php
$quryss = mysqli_query($con, "SELECT SUM(tblorders.Quantity * tblproducts.ProductPrice) AS todaySales 
                              FROM tblorders 
                              JOIN tblproducts ON tblproducts.id = tblorders.ProductId 
                              WHERE DATE(tblorders.InvoiceGenDate) = CURDATE()");
$rws = mysqli_fetch_array($quryss);
$todaySales = $rws['todaySales'] ? $rws['todaySales'] : 0; // Handle NULL case
?>
<div class="col-lg-3 col-md-6">
    <div class="card shadow-lg border-0 bg-gradient-info text-white"    >
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="fw-bold text-uppercase">Today's Sales</h6>
                </div>
                <div>
                    <i class="fas fa-building fa-2x"></i> <!-- Growth Icon -->
                </div>
            </div>
            <div class="text-center">
                <h2 class="fw-bold display-5 counter-anim"><?php echo number_format($todaySales, 2); ?></h2>
                <small class="text-white-50">Total Sales for Today</small>
            </div>
        </div>
    </div>
</div>

</div>
					
            </div>
            <!-- /Container -->
			
            <!-- Footer -->
<?php include_once('includes/footer.php');?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
	<script src="vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="dist/js/vectormap-data.js"></script>
    <script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    <script src="vendors/apexcharts/dist/apexcharts.min.js"></script>
	<script src="dist/js/irregular-data-series.js"></script>
    <script src="dist/js/init.js"></script>
	
</body>

</html>
<?php } ?>