<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
} else {

// Code for deletion   
if(isset($_GET['del'])){    
$cmpid=substr(base64_decode($_GET['del']),0,-5);
$query=mysqli_query($con,"delete from tblcategory where id='$cmpid'");
echo "<script>alert('Category record deleted.');</script>";   
echo "<script>window.location.href='manage-categories.php'</script>";
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

    <!-- Custom CSS -->
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        /* Breadcrumb */
        .hk-breadcrumb {
            background-color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Invoice Wrapper */
        .hk-invoice-wrap {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        /* Invoice Header */
        .invoice-from-wrap h3 {
            color: #007bff;
            font-weight: bold;
        }

        .invoice-from-wrap h4 {
            color: #333;
            font-weight: 600;
        }

        /* Table Styling */
        .table {
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .table th {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px;
            text-align: left;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Grand Total Row */
        .table tr:last-child th {
            background-color:rgb(50, 113, 230);
            color: white;
            text-align: center;
            font-size: 18px;
        }

        .table tr:last-child th:last-child {
            text-align: left;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .invoice-from-wrap {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    
    <div class="hk-wrapper hk-vertical-nav">
        <?php include_once('includes/navbar.php');
        include_once('includes/sidebar.php');
        ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>

        <div class="hk-pg-wrapper">
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
            </nav>

            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><i data-feather="file"></i></span> View Invoice</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="col-md-7 mb-20">
                                        <h3 class="mb-35 font-weight-600">GSMS</h3>
                                        <h6 class="mb-5">Grocery Shop Management System</h6>
                                    </div>

                                    <?php 
                                    $inid=$_SESSION['invoice'];
                                    $query=mysqli_query($con,"SELECT DISTINCT InvoiceNumber, CustomerName, CustomerContactNo, PaymentMode, InvoiceGenDate FROM tblorders WHERE InvoiceNumber='$inid'");
                                    while($row=mysqli_fetch_array($query)) {    
                                    ?>
                                    <div class="col-md-5 mb-20">
                                        <h4 class="mb-35 font-weight-600">Invoice / Receipt</h4>
                                        <span class="d-block">Date: <span class="pl-10 text-dark"><?php echo $row['InvoiceGenDate'];?></span></span>
                                        <span class="d-block">Invoice #<span class="pl-10 text-dark"><?php echo $row['InvoiceNumber'];?></span></span>
                                        <span class="d-block">Customer #<span class="pl-10 text-dark"><?php echo $row['CustomerName'];?></span></span>
                                        <span class="d-block">Mobile #<span class="pl-10 text-dark"><?php echo $row['CustomerContactNo'];?></span></span>
                                        <span class="d-block">Payment Mode #<span class="pl-10 text-dark"><?php echo $row['PaymentMode'];?></span></span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <hr class="mt-0">

                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table class="table mb-0" border="1">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Company</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $query=mysqli_query($con,"SELECT tblproducts.CategoryName, tblproducts.ProductName, tblproducts.CompanyName, tblproducts.ProductPrice, tblorders.Quantity FROM tblorders JOIN tblproducts ON tblproducts.id=tblorders.ProductId WHERE tblorders.InvoiceNumber='$inid'");
                                                $cnt=1;
                                                while($row=mysqli_fetch_array($query)) {    
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row['ProductName'];?></td>
                                                    <td><?php echo $row['CategoryName'];?></td>
                                                    <td><?php echo $row['CompanyName'];?></td>
                                                    <td><?php echo $qty=$row['Quantity'];?></td>
                                                    <td><?php echo $ppu=$row['ProductPrice'];?></td>
                                                    <td><?php echo $subtotal=number_format($ppu*$qty,2);?></td>
                                                </tr>
                                                <?php $grandtotal+=$subtotal; $cnt++; } ?>
                                                <tr>
                                                    <th colspan="6">Total</th> 
                                                    <th><?php echo number_format($grandtotal,2);?></th>   
                                                </tr>                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php');?>
        </div>
    </div>
</body>
</html>
<?php } ?>
