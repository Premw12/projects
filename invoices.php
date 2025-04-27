<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
} else {
    // Code for deletion   
    if (isset($_GET['del'])) {
        $decoded = base64_decode($_GET['del']);
        $cmpid = substr($decoded, 0, -5);
        $cmpid = mysqli_real_escape_string($con, $cmpid);
        $query = mysqli_query($con, "DELETE FROM tblorders WHERE InvoiceNumber='$cmpid'");
        if ($query) {
            echo "<script>alert('Invoice record deleted.');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
        echo "<script>window.location.href='invoices.php'</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Invoices</title>
    <!-- Data Table CSS -->
    <link href="vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

    <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }
    
            .hk-pg-title {
                font-weight: 600;
                color: #007bff;
            }
    
            .hk-sec-wrapper {
                background: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
    
            .form-control, .custom-select {
                border-radius: 8px;
                border: 1px solid #ced4da;
                transition: all 0.3s ease;
            }
    
            .form-control:focus, .custom-select:focus {
                border-color: #007bff;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }
    
            .btn-primary {
                background-color: #007bff;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
            }
    
            .btn-primary:hover {
                background-color: #0056b3;
                box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
            }
        </style>

</head>
<body>
    
   
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">
<!-- Top Navbar -->
<?php include_once('includes/navbar.php');
include_once('includes/sidebar.php');
?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
<li class="breadcrumb-item"><a href="#">Invoices</a></li>
<li class="breadcrumb-item active" aria-current="page">Manage</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

           
                <!-- Title -->
<div class="hk-pg-header">
 <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="database"></i></span></span>Manage Invoices</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Invocie Number</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Contact no.</th>
                                                    <th>Payment Mode</th>
                                                    <th>Invoice Gen. Date</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 
$rno=mt_rand(10000,99999); 
$query=mysqli_query($con,"select distinct InvoiceNumber,CustomerName,CustomerContactNo,PaymentMode,InvoiceGenDate  from tblorders");
$cnt=1;
while($row=mysqli_fetch_array($query))
{    
?>                                                
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row['InvoiceNumber'];?></td>
<td><?php echo $row['CustomerName'];?></td>
<td><?php echo $row['CustomerContactNo'];?></td>
<td><?php echo $row['PaymentMode'];?></td>
<td><?php echo $row['InvoiceGenDate'];?></td>
<td>
<a href="view-invoice.php?invid=<?php echo base64_encode($row['InvoiceNumber'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="View Details"> <i class="glyphicon glyphicon-envelope"></i></a>
<a href="invoices.php?del=<?php echo base64_encode($row['InvoiceNumber'] . $rno); ?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete this invoice?');">
        <i class="icon-trash txt-danger"></i>
    </a>
</td>
</tr>
<?php 
$cnt++;
} ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

            <!-- Footer -->
<?php include_once('includes/footer.php');?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->
    </div>
    <!-- /HK Wrapper -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/dataTables-data.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
    <script src="dist/js/init.js"></script>
</body>
</html>
<?php } ?>