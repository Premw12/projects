<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['login'])) {
    $adminuser = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = md5($_POST['password']);

    $query = mysqli_query($con, "SELECT ID FROM tbladmin WHERE UserName='$adminuser' AND Password='$password'");
    $ret = mysqli_fetch_array($query);

    if($ret > 0) {
        $_SESSION['aid'] = $ret['ID'];
        header('location:dashboard.php');
        exit();
    } else {
        $error_message = "❌ Invalid details. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grocery Shop Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right,rgb(173, 226, 237),rgb(24, 111, 154));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .input-group-text {
            background: transparent;
            border: none;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Grocery Shop Management</h2>

        <?php if(isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>

        <form method="post" action="">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <button type="submit" name="login" class="btn btn-danger w-100">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
