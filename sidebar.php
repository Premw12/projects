        <nav class="hk-nav hk-nav-light">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">

<li class="nav-item" style="position: relative; padding-left: 30px; margin-bottom: 10px;">
<i class="ion ion-ios-copy" 
       style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 22px; color:rgb(101, 153, 227);"></i>
       
<i class="ion ion-ios-speedometer" 
       style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 22px; color: #ffffff;"></i>
    <a class="nav-link" href="dashboard.php" 
       style="color: #fff; font-weight: bold; 
              background: linear-gradient(45deg,rgb(47, 219, 219),rgb(50, 120, 218)); 
              padding: 12px; border-radius: 5px; display: block; transition: 0.3s;">
        <span class="nav-link-text">Dashboard</span>
    </a>
</li>


<li class="nav-item" style="position: relative; padding-left: 30px; margin-bottom: 10px;">
    <i class="ion ion-ios-copy" 
       style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 22px; color:rgb(101, 153, 227);"></i>
    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#cats_drp" 
       style="color: #fff; font-weight: bold; background:linear-gradient(45deg,rgb(38, 176, 226),rgb(178, 230, 239)); padding: 12px; border-radius: 5px; 
              display: flex; align-items: center; justify-content: space-between;">
        <span class="nav-link-text">Category</span>
        <i class="ion ion-ios-arrow-down" style="color: #fff;"></i>
    </a>
    <ul id="cats_drp" class="nav flex-column collapse collapse-level-1" 
        style="background: #f1f8ff; padding: 10px; border-radius: 6px; margin-top: 5px; 
               box-shadow: 0px 3px 6px rgba(0,0,0,0.1);">
        <li class="nav-item">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="add-category.php" 
                       style="background: linear-gradient(45deg, #a1c4fd, #c2e9fb); color: #02577a; font-weight: bold; 
                              padding: 8px 14px; border-radius: 5px; display: flex; align-items: center; 
                              justify-content: center; transition: 0.3s; font-size: 13px; text-align: center; margin-bottom: 5px;">
                         Add Category
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-categories.php" 
                       style="background: linear-gradient(45deg, #a1c4fd, #c2e9fb); color: #02577a; font-weight: bold; 
                              padding: 8px 14px; border-radius: 5px; display: flex; align-items: center; 
                              justify-content: center; transition: 0.3s; font-size: 13px; text-align: center;">
                         Manage Categories
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="nav-item" style="position: relative; padding-left: 30px; margin-bottom: 10px;">
    <i class="ion ion-ios-business" 
       style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 22px; color:rgb(78, 143, 234);"></i>
    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#company_drp" 
       style="color: #fff; font-weight: bold; background: linear-gradient(45deg,rgb(117, 179, 211),rgb(29, 147, 220)); padding: 12px; border-radius: 5px; 
              display: flex; align-items: center; justify-content: space-between;">
        <span class="nav-link-text">Company</span>
        <i class="ion ion-ios-arrow-down" style="color: #fff;"></i>
    </a>
    <ul id="company_drp" class="nav flex-column collapse collapse-level-1" 
        style="background: #f1f8ff; padding: 10px; border-radius: 6px; margin-top: 5px; 
               box-shadow: 0px 3px 6px rgba(0,0,0,0.1);">
        <li class="nav-item">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="add-company.php" 
                       style="background: linear-gradient(45deg, #a1c4fd, #c2e9fb); color: #02577a; font-weight: bold; 
                              padding: 8px 14px; border-radius: 5px; display: flex; align-items: center; 
                              justify-content: center; transition: 0.3s; font-size: 13px; text-align: center; margin-bottom: 5px;">
                         Add Company
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-companies.php" 
                       style="background: linear-gradient(45deg, #a1c4fd, #c2e9fb); color: #02577a; font-weight: bold; 
                              padding: 8px 14px; border-radius: 5px; display: flex; align-items: center; 
                              justify-content: center; transition: 0.3s; font-size: 13px; text-align: center;">
                         Manage Companies
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<!-- Product Dropdown Menu -->
<li class="nav-item" style="position: relative; padding-left: 30px; margin-bottom: 10px;">
    <i class="ion ion-ios-list-box" 
       style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 22px; color:rgb(106, 181, 231);"></i>
    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#product_drp" 
       style="color: #fff; font-weight: bold; background:linear-gradient(45deg,rgb(60, 159, 240),rgb(123, 187, 230)); padding: 12px; border-radius: 5px; 
              display: flex; align-items: center; justify-content: space-between;">
        <span class="nav-link-text">Product</span>
        <i class="ion ion-ios-arrow-down" style="color: #fff;"></i>
    </a>
    <ul id="product_drp" class="nav flex-column collapse collapse-level-1" 
        style="background: #f1f8ff; padding: 10px; border-radius: 6px; margin-top: 5px; 
               box-shadow: 0px 3px 6px rgba(0,0,0,0.1);">
        <li class="nav-item">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="add-product.php" 
                       style="background: linear-gradient(45deg, #a1c4fd, #c2e9fb); color: #02577a; font-weight: bold; 
                              padding: 8px 14px; border-radius: 5px; display: flex; align-items: center; 
                              justify-content: center; transition: 0.3s; font-size: 13px; text-align: center; margin-bottom: 5px;">
                         Add Product
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-products.php" 
                       style="background: linear-gradient(45deg, #a1c4fd, #c2e9fb); color: #02577a; font-weight: bold; 
                              padding: 8px 14px; border-radius: 5px; display: flex; align-items: center; 
                              justify-content: center; transition: 0.3s; font-size: 13px; text-align: center;">
                         Manage Products
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<!-- Search Product Button -->
<li class="nav-item" style="position: relative; padding-left: 30px; margin-bottom: 10px;">
    <i class="glyphicon glyphicon-search" 
       style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 22px; color:rgb(85, 168, 235);"></i>
    <a class="nav-link" href="search-product.php" 
       style="color: #fff; font-weight: bold; background:  linear-gradient(45deg,rgb(130, 187, 241),rgb(30, 122, 208)); padding: 12px; border-radius: 5px; display: block;">
        <span class="nav-link-text">Search Product</span>
    </a>
</li>
<li class="nav-item" style="position: relative; padding-left: 30px; margin-bottom: 10px;">
    <i class="ion ion-ios-list-box" 
       style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 22px; color:rgb(102, 188, 228);"></i>
    <a class="nav-link" href="invoices.php" 
       style="color: #fff; font-weight: bold; background: linear-gradient(45deg,rgb(22, 196, 223),rgb(158, 218, 244)); padding: 12px; border-radius: 5px; display: block; transition: 0.3s;">
        <span class="nav-link-text">Invoices</span>
    </a>
</li>


<!-- Reports Dropdown -->
<li class="nav-item" style="position: relative; padding-left: 30px; margin-bottom: 15px;">
    <i class="ion ion-ios-today" 
       style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 22px; color:rgb(46, 177, 229);"></i>
    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#reports_drp" 
       style="color: #fff; font-weight: bold; background: linear-gradient(45deg,rgb(60, 144, 218),rgb(131, 199, 232)); padding: 12px; border-radius: 5px; 
              display: flex; align-items: center; justify-content: space-between; transition: 0.3s;">
        <span class="nav-link-text">Reports</span>
        <i class="ion ion-ios-arrow-down" style="color: #fff;"></i>
    </a>
    <ul id="reports_drp" class="nav flex-column collapse collapse-level-1" 
        style="background: #f1f8ff; padding: 8px; border-radius: 6px; margin-top: 5px; box-shadow: 0px 3px 6px rgba(0,0,0,0.1);">
        <li class="nav-item">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="bwdate-report-ds.php" 
                       style="background: linear-gradient(45deg, #a1c4fd, #c2e9fb); color: #02577a; font-weight: bold; padding: 8px 12px; 
                              border-radius: 5px; display: flex; align-items: center; justify-content: center; 
                              transition: 0.3s; font-size: 14px; text-align: center; margin-bottom: 5px;">
                         B/w Dates
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sales-report-ds.php" 
                       style="background: linear-gradient(45deg, #a1c4fd, #c2e9fb); color: #02577a; font-weight: bold; padding: 8px 12px; 
                              border-radius: 5px; display: flex; align-items: center; justify-content: center; 
                              transition: 0.3s; font-size: 14px; text-align: center;">
                         Sales
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>

                  
                
                    <hr class="nav-separator">
            
                </div>
            </div>
        </nav>