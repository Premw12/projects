<style>
    /* Navbar Styling */
    .custom-navbar {
        background: linear-gradient(135deg,rgb(64, 164, 227),rgb(156, 210, 225)); /* Blue gradient */
        padding: 12px 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Navbar Brand */
    .custom-navbar .navbar-brand {
        font-size: 20px;
        font-weight: bold;
        color: #fff;
        text-transform: uppercase;
        transition: 0.3s;
    }

    .custom-navbar .navbar-brand:hover {
        color:rgb(176, 224, 242); /* Yellow hover */
        transform: scale(1.05);
    }

    /* Nav Links */
    .custom-navbar .nav-link {
        color: #fff !important;
        font-weight: 500;
        padding: 10px 15px;
        transition: 0.3s ease-in-out;
    }

    /* Hover Effect */
    .custom-navbar .nav-link:hover {
        color:rgb(18, 134, 158) !important;
        text-shadow: 0 0 10px rgba(163, 218, 233, 0.7);
    }

    /* Profile Avatar */
    .custom-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #fff;
        transition: 0.3s;
    }

    .custom-avatar:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    /* Dropdown Styling */
    .dropdown-menu {
        border-radius: 10px;
        background: rgba(0, 0, 0, 0.9);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.3s ease-in-out;
    }

    .dropdown-menu .dropdown-item {
        color: #fff;
        font-weight: 500;
        padding: 10px 15px;
        transition: 0.3s;
    }

    /* Reduce Navbar Height */
.custom-navbar {
    padding: 4px 10px; /* Reduce padding */
    min-height: 45px; /* Adjust height */
}

/* Reduce Padding for Navbar Links */
.custom-navbar .nav-link {
    padding: 6px 10px; /* Reduce padding inside links */
    font-size: 14px; /* Slightly smaller text */
}

/* Reduce Avatar Size */
.custom-avatar {
    width: 30px; /* Smaller avatar */
    height: 30px;
    border-radius: 50%;
    border: 2px solid #fff;
}

/* Navbar Styling */
.custom-navbar {
    background: linear-gradient(135deg, rgb(27, 118, 222),rgb(50, 202, 236)); /* Blue gradient */
    padding: 4px 15px; /* Reduce padding */
    min-height: 45px; /* Decrease navbar height */
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Move Brand Name to the Right */
.custom-navbar .navbar-brand {
    font-size: 18px; /* Slightly smaller font */
    font-weight: bold;
    color: #fff;
    text-transform: uppercase;
    transition: 0.3s;
    margin-left: auto; /* Pushes it to the right */
    margin-right: 20px; /* Adjust spacing from the edge */
}

/* Navbar Brand Hover Effect */
.custom-navbar .navbar-brand:hover {
    color:rgb(11, 9, 100); /* Yellow hover */
    transform: scale(1.05);
}

/* Adjust Navbar Links */
.custom-navbar .nav-link {
    padding: 6px 10px;
    font-size: 14px;
}

/* Adjust Profile Avatar */
.custom-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid #fff;
}



/* Reduce Dropdown Font Size */
.dropdown-menu .dropdown-item {
    font-size: 14px; /* Smaller dropdown items */
    padding: 8px 12px; /* Adjust padding */
}


    .dropdown-menu .dropdown-item:hover {
        background:rgb(106, 171, 240);
        color: #fff;
    }
    .custom-navbar {
    padding: 3px 10px; /* Reduce padding to decrease height */
    min-height: 10px; /* Adjust height */
}

    /* Dropdown Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<nav class="navbar navbar-expand-xl custom-navbar fixed-top">
    <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover text-white" href="javascript:void(0);">
        <i class="ion ion-ios-menu"></i>
    </a>
    <a class="navbar-brand" href="dashboard.php">GROCERY SHOP MANAGEMENT SYSTEM</a>
    <ul class="navbar-nav ml-auto">
        <!-- User Profile Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                    <img src="dist/img/user.png" alt="user" class="custom-avatar">
                    <span class="ml-2 text-white">
                        <?php 
                        $adminid=$_SESSION['aid'];
                        $query=mysqli_query($con,"select AdminName from tbladmin where id='$adminid'");
                        $row=mysqli_fetch_array($query);
                        echo $row['AdminName'];
                        ?>
                        <i class="zmdi zmdi-chevron-down"></i>
                    </span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php"><i class="zmdi zmdi-account mr-2"></i> Profile</a>
                <a class="dropdown-item" href="change-password.php"><i class="zmdi zmdi-settings mr-2"></i> Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php"><i class="zmdi zmdi-power mr-2"></i> Log out</a>
            </div>
        </li>
    </ul>
</nav>
