  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Gerona Marketplace</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $this->session->user_photo; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->user_fullname; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $this->session->photo_path; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->user_fullname; ?> - <?php echo $this->session->user_group; ?>
                  <!-- <small>Member since Nov. <?php echo $this->session->date_created; ?></small> -->
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer" style="background-color:#c0392b">
                <!-- <div class="pull-left"> -->
                  <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                <!-- </div>
                <div class="pull-right">
                  <a href="Login/transaction/logout" class="btn btn-default btn-flat">Sign out</a>
                </div> -->
                <center><a style="color:white;background-color:#c0392b;font-size:15px;border:0px;width:100%;" href="MyAccount/transaction/logout" class="btn btn-default btn-flat">Logout</a></center>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- for loader -->
  <div class="loader">
  </div>
