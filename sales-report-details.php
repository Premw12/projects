<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Code for deletion   
if(isset($_GET['del'])){    
$cmpid=substr(base64_decode($_GET['del']),0,-5);
$query=mysqli_query($con,"delete from tblcategory where id='$cmpid'");
echo "<script>alert('Category record deleted.');</script>";   
echo "<script>window.location.href='manage-categories.php'</script>";
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Invoices</title>
    
    <!-- Data Table CSS & UI Styling -->
    <link href="vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .hk-pg-title {
            color: #333;
            font-weight: bold;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="hk-wrapper hk-vertical-nav">
        
        <!-- Top Navbar & Sidebar -->
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>
        
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        
        <div class="hk-pg-wrapper">
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Reports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sales Report Details</li>
                </ol>
            </nav>
            
            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title">
                        <span class="pg-title-icon">
                            <i class="feather-icon" data-feather="database"></i>
                        </span>
                        Sales report from <?php echo $_POST['fromdate']; ?> to <?php echo $_POST['todate']; ?>
                    </h4>
                </div>
                
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="table-wrap">
                                <table id="datable_1" class="table table-hover w-100 display pb-30">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Month / Year</th>
                                            <th>Sale Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $query = mysqli_query($con, "SELECT MONTH(tblorders.InvoiceGenDate) as mnth, YEAR(tblorders.InvoiceGenDate) as yearr, SUM(tblorders.Quantity * tblproducts.ProductPrice) as tt FROM tblorders JOIN tblproducts ON tblproducts.id = tblorders.ProductId WHERE DATE(tblorders.InvoiceGenDate) BETWEEN '$_POST[fromdate]' AND '$_POST[todate]' GROUP BY mnth, yearr");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($query)) { ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row['mnth'] . "/" . $row['yearr']; ?></td>
                                                <td><?php echo number_format($row['tt'], 2); ?></td>
                                            </tr>
                                        <?php 
                                            $cnt++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
    </div>
    
    <!-- Scripts -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/dataTables-data.js"></script>
    <script src="dist/js/init.js"></script>
</body>
</html>
<?php } ?>