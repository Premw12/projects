<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Add company Code
if(isset($_POST['submit']))
{
//Getting Post Values
$cname=$_POST['companyname'];   
$query=mysqli_query($con,"insert into tblcompany(CompanyName) values('$cname')"); 
if($query){
echo "<script>alert('Company added successfully.');</script>";   
echo "<script>window.location.href='add-company.php'</script>";
} else{
echo "<script>alert('Something went wrong. Please try again.');</script>";   
echo "<script>window.location.href='add-company.php'</script>";    
}
}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Sales Report</title>
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
<li class="breadcrumb-item"><a href="#">Reports</a></li>
<li class="breadcrumb-item active" aria-current="page">Sales Report</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Sales Report Date Selection</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" action="sales-report-details.php" novalidate>
                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">From Date</label>
<input class="form-control" type="date" name="fromdate" required />
<div class="invalid-feedback">Please provide a valid from date.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">To Date</label>
<input class="form-control" type="date" name="todate" required  />
<div class="invalid-feedback">Please provide a valid to date.</div>
</div>
</div>                                 
<button class="btn btn-primary" type="submit" name="submit">Submit</button>
</form>
</div>
</div>
</section>
                     
</div>
</div>
</div>


            <!-- Footer -->
<?php include_once('includes/footer.php');?>
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->

    </div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
    <script src="dist/js/init.js"></script>
    <script src="dist/js/validation-data.js"></script>

</body>
</html>
<?php } ?>