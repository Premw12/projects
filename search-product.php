<?php
session_start();
include('includes/config.php'); // Ensure this file contains your database connection details

// Function to fetch products by category
function getProductsByCategory($con, $category) {
    $query = "SELECT * FROM tblproducts WHERE CategoryName = '$category'";
    $result = mysqli_query($con, $query);
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    return $products;
}

// Function to fetch all products
function getAllProducts($con) {
    $query = "SELECT * FROM tblproducts";
    $result = mysqli_query($con, $query);
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    return $products;
}

// Function to search products by name
function searchProducts($con, $searchTerm) {
    $query = "SELECT * FROM tblproducts WHERE ProductName LIKE '%$searchTerm%'";
    $result = mysqli_query($con, $query);
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    return $products;
}

// Handle cart actions (add, remove, empty)
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $pid = $_GET["pid"];
                $result = mysqli_query($con, "SELECT * FROM tblproducts WHERE id='$pid'");
                while ($productByCode = mysqli_fetch_array($result)) {
                    $itemArray = array(
                        $productByCode["id"] => array(
                            'catname' => $productByCode["CategoryName"],
                            'compname' => $productByCode["CompanyName"],
                            'quantity' => $_POST["quantity"][0],
                            'pname' => $productByCode["ProductName"],
                            'price' => $productByCode["ProductPrice"],
                            'code' => $productByCode["id"]
                        )
                    );
                    if (!empty($_SESSION["cart_item"])) {
                        if (isset($_SESSION["cart_item"][$productByCode["id"]])) {
                            $_SESSION["cart_item"][$productByCode["id"]]["quantity"] += (int)$_POST["quantity"][0];
                        } else {
                            $_SESSION["cart_item"] += $itemArray; // Use union operator
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            }
            break;

           case "remove":
    if (!empty($_SESSION["cart_item"])) {
        foreach ($_SESSION["cart_item"] as $k => $v) {
            if ($_GET["code"] == $k) {
                unset($_SESSION["cart_item"][$k]);
            }
        }
        // Check if cart is empty after removal
        if (empty($_SESSION["cart_item"])) {
            unset($_SESSION["cart_item"]);
        }
    }
    break; 


        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}

// Handle checkout
if (isset($_POST['checkout'])) {
    // Check if quantity and productid arrays are set
    if (isset($_POST['quantity']) && isset($_POST['productid'])) {
        $invoiceno = mt_rand(100000000, 999999999);
        $pid = $_POST['productid']; // Array of product IDs
        $quantity = $_POST['quantity']; // Array of quantities
        $cname = $_POST['customername'];
        $cmobileno = $_POST['mobileno'];
        $pmode = $_POST['paymentmode'];

        // Combine product IDs and quantities into an associative array
        $value = array_combine($pid, $quantity);

        foreach ($value as $pdid => $qty) {
            // Check stock availability
            $checkStock = mysqli_query($con, "SELECT ProductQuantity FROM tblproducts WHERE id = '$pdid'");
            $stockData = mysqli_fetch_assoc($checkStock);

            if ($stockData['ProductQuantity'] < $qty) {
                echo '<script>alert("Not enough stock for this product");</script>';
                echo "<script>window.location.href='search-product.php'</script>";
                exit();
                
            }

            // Insert order into the database
            $query = mysqli_query($con, "INSERT INTO tblorders(ProductId, Quantity, InvoiceNumber, CustomerName, CustomerContactNo, PaymentMode) VALUES('$pdid', '$qty', '$invoiceno', '$cname', '$cmobileno', '$pmode')");
            $updateStock = mysqli_query($con, "UPDATE tblproducts SET ProductQuantity = ProductQuantity - $qty WHERE id = '$pdid'");
        }

        echo '<script>alert("Invoice generated successfully. Invoice number is ' . $invoiceno . '")</script>';
        unset($_SESSION["cart_item"]);
        $_SESSION['invoice'] = $invoiceno;
        echo "<script>window.location.href='invoice.php'</script>";
    } else {
        echo '<script>alert("Error: Quantity or product data is missing.")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Search Product</title>
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        .main-container {
            display: flex;
        }

        /* Original Sidebar Styles (Left Side) */
        .original-sidebar {
            width: 20%;
            background-color: #333;
            min-height: 100vh;
        }

        /* Content Area */
        .content-area {
            width: 80%;
            padding: 20px;
        }

        /* Search Bar Styles */
        .search-bar {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-bar input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .search-bar button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        /* Categories Sidebar (Now Below Search) */
        .categories-sidebar {
            background-color: #333;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .categories-sidebar h2 {
            color: #fff;
            text-align: center;
        }

        .category-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .category-list li {
            margin: 5px;
        }

        .category-list a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            background-color: #444;
            transition: background-color 0.3s ease;
        }

        .category-list a:hover {
            background-color: #555;
        }

        /* Product Section Styles */
        .product-section {
            margin-bottom: 20px;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            width: 200px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .product-card p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .add-to-cart-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #218838;
        }

        /* Cart Section Styles */
        .cart-section {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cart-section h2 {
            margin-bottom: 20px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #f8f9fa;
        }

        .cart-actions {
            margin-top: 20px;
            text-align: right;
        }

        .cart-actions button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .cart-actions button:hover {
            background-color: #c82333;
        }

        /* Checkout Form Styles */
        .checkout-form {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .checkout-form h2 {
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .checkout-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .checkout-button:hover {
            background-color: #0056b3;
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
           


           

            <!-- Search Bar -->
            <div class="search-bar">
                <form method="get" action="">
                    <input type="text" name="search" placeholder="Search products...">
                    <button type="submit">Search</button>
                </form>
            </div>

            <!-- Categories Sidebar (Now Below Search) -->
            <div class="categories-sidebar">
                <h2>Categories</h2>
                <ul class="category-list">
                    <li><a href="?category=all">All Products</a></li>
                    <?php
                    // Fetch all categories from the database
                    $categoriesQuery = "SELECT DISTINCT CategoryName FROM tblproducts";
                    $categoriesResult = mysqli_query($con, $categoriesQuery);
                    while ($row = mysqli_fetch_assoc($categoriesResult)) {
                        echo "<li><a href='?category=" . urlencode($row['CategoryName']) . "'>" . $row['CategoryName'] . "</a></li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- Product Section -->
            <div class="product-section">
                <?php
                // Display products based on search or category
                if (isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $products = searchProducts($con, $searchTerm);
                    echo "<h2>Search Results for '$searchTerm'</h2>";
                } elseif (isset($_GET['category'])) {
                    $category = $_GET['category'];
                    if ($category == 'all') {
                        $products = getAllProducts($con);
                        echo "<h2>All Products</h2>";
                    } else {
                        $products = getProductsByCategory($con, $category);
                        echo "<h2>$category</h2>";
                    }
                } else {
                    $products = getAllProducts($con);
                    echo "<h2>All Products</h2>";
                }

                if (!empty($products)) {
                    echo "<div class='product-list'>";
                    foreach ($products as $product) {
                        echo "<div class='product-card'>";
                        echo "<h3>" . $product['ProductName'] . "</h3>";
                        echo "<p>Price: " . $product['ProductPrice'] . "</p>";
                        echo "<form method='post' action='?action=add&pid=" . $product['id'] . "'>";
                        echo "<input type='number' name='quantity[]' value='1' min='1' max='10'>";
                        echo "<button type='submit' class='add-to-cart-btn'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No products found.</p>";
                }
                ?>
            </div>

            <!-- Cart Section -->
            <div class="cart-section">
                <h2>Your Cart</h2>
                <?php
                if (!empty($_SESSION["cart_item"])) {
                    echo "<table class='cart-table'>";
                    echo "<thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Action</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($_SESSION["cart_item"] as $item) {
                        echo "<tr>";
                        echo "<td>" . $item['pname'] . "</td>";
                        echo "<td>" . $item['quantity'] . "</td>";
                        echo "<td>$" . $item['price'] . "</td>";
                        echo "<td><a href='?action=remove&code=" . $item['code'] . "'><button>Remove</button></a></td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    echo "<div class='cart-actions'>";
                    echo "<a href='?action=empty'><button>Empty Cart</button></a>";
                    echo "</div>";
                } else {
                    echo "<p>Your cart is empty.</p>";
                }
                ?>
            </div>

            <!-- Checkout Form -->
            <div class="checkout-form">
                <h2>Checkout</h2>
                <form method="post">
                    <input type="text" name="customername" placeholder="Customer Name" required class="form-input">
                    <input type="text" name="mobileno" placeholder="Mobile Number" required class="form-input">
                    <select name="paymentmode" required class="form-input">
                        <option value="" disabled selected>Select Payment Mode</option>
                        <option value="Cash">Cash</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Online">Online</option>
                    </select>

                    <!-- Hidden fields for product IDs and quantities -->
                    <?php
                    if (!empty($_SESSION["cart_item"])) {
                        foreach ($_SESSION["cart_item"] as $item) {
                            echo "<input type='hidden' name='productid[]' value='" . $item['code'] . "'>";
                            echo "<input type='hidden' name='quantity[]' value='" . $item['quantity'] . "'>";
                        }
                    }
                    ?>

                    <button type="submit" name="checkout" class="checkout-button">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
            <!-- /Breadcrumb -->

            <!-- Container -->




    




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
    <style type="text/css">
        #btnEmpty {
    background-color: #ffffff;
    border:rgb(24, 116, 221) 1px solid;
    padding: 5px 10px;
    color:rgb(107, 171, 236);
    float: right;
    text-decoration: none;
    border-radius: 3px;
    margin: 10px 0px;
}

    </style>

</body>
</html>
