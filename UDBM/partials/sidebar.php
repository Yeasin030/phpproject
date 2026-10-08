<aside class="sidebar-wrapper">
          <div class="sidebar-header">
            <div class="logo-icon">
              <img src="assets/images/logo-icon.png" class="logo-img" alt="">
            </div>
            <div class="logo-name flex-grow-1">
              <h5 class="mb-0">Roksyn</h5>
            </div>
            <div class="sidebar-close ">
              <span class="material-symbols-outlined">close</span>
            </div>
          </div>
          <div class="sidebar-nav" data-simplebar="true">
            
              <!--navigation-->
              <ul class="metismenu" id="menu">
                <li>
                  <a href="dashboard.php">
                    <div class="parent-icon"><span class="material-symbols-outlined">home</span>
                    </div>
                    <div class="menu-title">Dashboard</div>
                  </a>
                </li>
              <ul class="metismenu" id="menu">
                <li>
                  <a href="Addstudent.php">
                    <div class="parent-icon"><span class="material-symbols-outlined">home</span>
                    </div>
                    <div class="menu-title">Addstudent</div>
                  </a>
                </li>
              <ul class="metismenu" id="menu">
                
              
          </div>
          <div class="sidebar-bottom dropdown dropup-center dropup">
              <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
                <div class="user-img">
                   <img src="assets/images/avatars/01.png" alt="">
                </div>
                <div class="user-info">
                  <h5 class="mb-0 user-name"><?php echo $_SESSION['name'];?></h5>
                  <p class="mb-0 user-designation">UI Engineer</p>
                </div>
              </div>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  account_circle
                  </span><span>Profile</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  tune
                  </span><span>Settings</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  dashboard
                  </span><span>Dashboard</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  account_balance
                  </span><span>Earnings</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  cloud_download
                  </span><span>Downloads</span></a>
                </li>
                <li>
                  <div class="dropdown-divider mb-0"></div>
                </li>
                <li><a class="dropdown-item" href="logout.php"><span class="material-symbols-outlined me-2">
                  logout
                  </span><span>Logout</span></a>
                </li>
              </ul>
          </div>
     </aside>