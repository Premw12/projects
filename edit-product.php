<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
 // Edit product Code
 if (isset($_POST['update'])) {
    $pid = substr(base64_decode($_GET['pid']), 0, -5);
    // Getting Post Values
    $catname = $_POST['category'];
    $company = $_POST['company'];
    $pname = $_POST['productname'];
    $pprice = $_POST['productprice'];
    $pqty = $_POST['productquantity'];

    $query = mysqli_query($con, "UPDATE tblproducts SET CategoryName='$catname', CompanyName='$company', ProductName='$pname', ProductPrice='$pprice', ProductQuantity='$pqty' WHERE id='$pid'");

    echo "<script>alert('Product updated successfully.');</script>";
    echo "<script>window.location.href='manage-products.php'</script>";
}


    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Add Product</title>
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
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
<li class="breadcrumb-item"><a href="#">Product</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Edit Product</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
<section class="hk-sec-wrapper">

<div class="row">
<div class="col-sm">
<form class="needs-validation" method="post" novalidate>
<?php
$pid=substr(base64_decode($_GET['pid']),0,-5);
$query=mysqli_query($con,"select * from tblproducts where id='$pid'");
while($result=mysqli_fetch_array($query))
{    
?>                                       
<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Category</label>
 <select class="form-control custom-select" name="category" required>
<option value="<?php echo $result['CategoryName'];?>"><?php echo $catname=$result['CategoryName'];?></option>
<?php
$ret=mysqli_query($con,"select CategoryName from tblcategory");
while($row=mysqli_fetch_array($ret))
{?>
<option value="<?php echo $row['CategoryName'];?>"><?php echo $row['CategoryName'];?></option>
<?php } ?>
</select>
<div class="invalid-feedback">Please select a category.</div>
</div>
</div>

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Company</label>
 <select class="form-control custom-select" name="company" required>
<option value="<?php echo $result['CompanyName'];?>"><?php echo $result['CompanyName'];?></option>
<?php
$ret=mysqli_query($con,"select CompanyName from tblcompany");
while($rw=mysqli_fetch_array($ret))
{?>
<option value="<?php echo $rw['CompanyName'];?>"><?php echo $rw['CompanyName'];?></option>
<?php } ?>
</select>
<div class="invalid-feedback">Please select a company.</div>
</div>
</div>
 <div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Product Name</label>
<input type="text" class="form-control" id="validationCustom03" value="<?php echo $result['ProductName'];?>" name="productname" required>
<div class="invalid-feedback">Please provide a valid product name.</div>
</div>
</div>   

<div class="form-row">
<div class="col-md-6 mb-10">
<label for="validationCustom03">Product Price</label>
<input type="text" class="form-control" id="validationCustom03" value="<?php echo $result['ProductPrice'];?>" name="productprice" required>
<div class="invalid-feedback">Please provide a valid product price.</div>
</div>
</div>

<div class="form-row">
    <div class="col-md-6 mb-10">
        <label for="validationCustom04">Product Quantity</label>
        <input type="text" class="form-control" id="validationCustom04" value="<?php echo $result['ProductQuantity'];?>" name="productquantity" required>
        <div class="invalid-feedback">Please provide a valid product quantity.</div>
    </div>
</div>

<?php } ?>
<button class="btn btn-primary" type="submit" name="update">Update</button>
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