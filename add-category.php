<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Add Category Code
if(isset($_POST['submit']))
{
//Getting Post Values
$catname=$_POST['category']; 
$catcode=$_POST['categorycode'];   
$query=mysqli_query($con,"insert into tblcategory(CategoryName,CategoryCode) values('$catname','$catcode')"); 
if($query){
echo "<script>alert('Category added successfully.');</script>";   
echo "<script>window.location.href='add-category.php'</script>";
} else{
echo "<script>alert('Something went wrong. Please try again.');</script>";   
echo "<script>window.location.href='add-category.php'</script>";    
}
}

    ?><!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Add Category</title>
    
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
    
            .form-control {
                border-radius: 8px;
                border: 1px solid #ced4da;
                transition: all 0.3s ease;
            }
    
            .form-control:focus {
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
                            <span class="pg-title-icon"><i class="fas fa-plus-circle text-primary"></i></span>
                            Add Category
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
    
                                            <!-- Category Name -->
                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="category">Category Name</label>
                                                <input type="text" class="form-control" id="category" placeholder="Enter Category Name" name="category" required>
                                                <div class="invalid-feedback">Please provide a valid category name.</div>
                                            </div>
    
                                            <!-- Category Code -->
                                            <div class="form-group mb-3">
                                                <label class="fw-bold" for="categorycode">Category Code</label>
                                                <input type="text" class="form-control" id="categorycode" placeholder="Enter Category Code" name="categorycode" required>
                                                <div class="invalid-feedback">Please provide a valid category code.</div>
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