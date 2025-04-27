<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Add product Code
if(isset($_POST['submit']))
{
//Getting Post Values



//Getting Post Values
$catname = $_POST['category']; 
$company = $_POST['company'];   
$pname = $_POST['productname'];
$pprice = $_POST['productprice'];
$pquantity = $_POST['productquantity'];
$pweight = $_POST['productweight'];
$wunit = $_POST['weightunit'];




if((ctype_alnum($_POST['productname']) || ctype_alnum($_POST['weightunit']))){

    echo "<script>alert('Please enter valid data.');</script>"; 
    echo "<script>window.location.href='add-product.php'</script>";
}
else {
    $query = mysqli_query($con, "INSERT INTO tblproducts(CategoryName, CompanyName, ProductName, ProductPrice, ProductWeight,WeightUnit, ProductQuantity) 
VALUES('$catname', '$company', '$pname', '$pprice','$pweight', '$wunit', '$pquantity')"); 
    if ($query) {
        echo "<script>alert('Product added successfully.');</script>";   
        echo "<script>window.location.href='add-product.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";   
        echo "<script>window.location.href='add-product.php'</script>";    
    }
 
}




}
}

    ?><!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Add Product</title>
    
        <!-- External CSS -->
        <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
        <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
        <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    
        <!-- Bootstrap & FontAwesome -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
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
            include_once('includes/sidebar.php'); ?>
            
            <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
    
            <!-- Main Content -->
            <div class="hk-pg-wrapper">
                <!-- Breadcrumb -->
                <nav class="hk-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light bg-transparent">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                    </ol>
                </nav>
                <!-- /Breadcrumb -->
    
                <!-- Container -->
                <div class="container">
                    <!-- Title -->
                    <div class="hk-pg-header">
                        <h4 class="hk-pg-title">
                            <span class="pg-title-icon"><i class="fas fa-box-open text-primary"></i></span>
                            Add Product
                        </h4>
                    </div>
                    <!-- /Title -->
    
                    <!-- Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <section class="hk-sec-wrapper">
                                <div class="row">
                                    <div class="col-sm">
                                        <form class="needs-validation" method="post" novalidate>
    
                                            <!-- Category Dropdown -->
                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="category">Category</label>
                                                <select class="form-control custom-select" name="category" required>
                                                    <option value="">Select category</option>
                                                    <?php
                                                    $ret = mysqli_query($con, "SELECT CategoryName FROM tblcategory");
                                                    while ($row = mysqli_fetch_array($ret)) { ?>
                                                        <option value="<?php echo $row['CategoryName']; ?>"><?php echo $row['CategoryName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Please select a category.</div>
                                            </div>
    
                                            <!-- Company Dropdown -->
                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="company">Company</label>
                                                <select class="form-control custom-select" name="company" required>
                                                    <option value="">Select Company</option>
                                                    <?php
                                                    $ret = mysqli_query($con, "SELECT CompanyName FROM tblcompany");
                                                    while ($row = mysqli_fetch_array($ret)) { ?>
                                                        <option value="<?php echo $row['CompanyName']; ?>"><?php echo $row['CompanyName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Please select a company.</div>
                                            </div>
    
                                            <!-- Product Name -->
                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="productname">Product Name</label>
                                                <input type="" class="form-control" id="productname" placeholder="Enter Product Name" name="productname" required>
                                                <div class="invalid-feedback">Please provide a valid product name.</div>
                                            </div>
    
                                            <!-- Product Price -->
                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="productprice">Product Price</label>
                                                <input type="number" class="form-control" id="productprice" placeholder="Enter Product Price" name="productprice" required>
                                                <div class="invalid-feedback">Please provide a valid product price.</div>
                                            </div>





                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="productweight">Product weight</label>
                                                <input type="number" class="form-control" id="productweight" placeholder="Enter Product weight" name="productweight" required>
                                                <div class="invalid-feedback">Please provide a valid product weight.</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="weightunit">weight unit</label>
                                                <input type="text" class="form-control" id="weightunit" placeholder="Enter weight unit " name="weightunit" required>
                                                <div class="invalid-feedback">Please provide a valid weight unit </div>
                                            </div>



                                            
                                            <!-- Product Quantity -->
                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="productquantity">Product Quantity</label>
                                                <input type="number" class="form-control" id="productquantity" placeholder="Enter Product Quantity" name="productquantity" required>
                                               <div class="invalid-feedback">Please provide a valid product quantity.</div>
                                            </div>
    
                                            <!-- Submit Button -->
                                            <button class="btn btn-primary w-100" type="submit" name="submit">
                                                <i class="fas fa-save"></i> Submit
                                            </button>
    
                                        </form>
                                    </div>
                                </div>
                            </section>
                         </div>
                    </div>
                </div>
    
                <!-- Footer -->
                <?php include_once('includes/footer.php'); ?>
                <!-- /Footer -->
            </div>
            <!-- /Main Content -->
        </div>
    
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    </body>
    </html>
    

