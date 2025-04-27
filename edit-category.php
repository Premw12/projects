<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid'] == 0)) {
    header('location:logout.php');
} else {
    // Update Category Code
    if (isset($_POST['update'])) {
        $cid = substr(base64_decode($_GET['catid']), 0, -5);
        $catname = $_POST['category'];
        $catcode = $_POST['categorycode'];
        
        $query = mysqli_query($con, "UPDATE tblcategory SET CategoryName='$catname', CategoryCode='$catcode' WHERE id='$cid'");
        echo "<script>alert('Category updated successfully.');</script>";
        echo "<script>window.location.href='manage-categories.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Edit Category</title>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
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
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="hk-wrapper hk-vertical-nav">
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>
        <div class="hk-pg-wrapper">
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title">Edit Category</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate>
                                        <?php
                                        $cid = substr(base64_decode($_GET['catid']), 0, -5);
                                        $ret = mysqli_query($con, "SELECT * FROM tblcategory WHERE ID='$cid'");
                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" value="<?php echo $row['CategoryName']; ?>" name="category" required>
                                                <div class="invalid-feedback">Please provide a valid category name.</div>
                                            </div>
                                            <div class="form-group">
                                                <label>Category Code</label>
                                                <input type="text" class="form-control" value="<?php echo $row['CategoryCode']; ?>" name="categorycode" required>
                                                <div class="invalid-feedback">Please provide a valid category code.</div>
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
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
