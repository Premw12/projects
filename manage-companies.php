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
$query=mysqli_query($con,"delete from tblcompany where id='$cmpid'");
echo "<script>alert('Company record deleted.');</script>";   
echo "<script>window.location.href='manage-companies.php'</script>";
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Companies</title>

    <!-- Data Tables & Bootstrap -->
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
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .icon-pencil {
            color: #28a745;
        }
        .icon-trash {
            color: #dc3545;
        }
    </style>
</head>

<body>

    <!-- Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar & Sidebar -->
        <?php include_once('includes/navbar.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Company</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage</li>
                </ol>
            </nav>

            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title">
                        <span class="pg-title-icon">
                            <i class="icon-database"></i>
                        </span>
                        Manage Companies
                    </h4>
                </div>

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
                                                    <th>Company Name</th>
                                                    <th>Posting Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $rno = mt_rand(10000, 99999);
                                                $query = mysqli_query($con, "SELECT * FROM tblcompany");
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $row['CompanyName']; ?></td>
                                                        <td><?php echo $row['PostingDate']; ?></td>
                                                        <td>
                                                            <a href="edit-company.php?compid=<?php echo base64_encode($row['id'] . $rno); ?>" data-toggle="tooltip" title="Edit">
                                                                <i class="icon-pencil"></i>
                                                            </a>
                                                            &nbsp; &nbsp;
                                                            <a href="manage-companies.php?del=<?php echo base64_encode($row['id'] . $rno); ?>" onclick="return confirm('Do you really want to delete?');" data-toggle="tooltip" title="Delete">
                                                                <i class="icon-trash"></i>
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

            </div>

            <!-- Footer -->
            <?php include_once('includes/footer.php'); ?>

        </div>
    </div>

    <!-- Scripts -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
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