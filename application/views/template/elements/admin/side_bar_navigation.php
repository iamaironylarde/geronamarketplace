  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->session->user_photo; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php echo $this->session->user_fullname; ?> </p>
          <a ><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="Index">
            <i class="fa fa-dashboard"></i> <span>Homepage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <?php
          if($this->session->user_group_id==3){
        ?>
        <li class="treeview">
          <a href="#" class="shopname">
            <i class="fa fa-dashboard"></i> <span>Shop Name</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <?php } ?>

        <li class="treeview">
          <a href="Products">
            <i class="fa fa-dashboard"></i> <span>My Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="AdminReservations">
            <i class="fa fa-dashboard"></i> <span>Reservations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="Orders">
            <i class="fa fa-dashboard"></i> <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        
        <?php
          if($this->session->user_group_id==1){
        ?>
        <li class="treeview">
          <a href="Category">
            <i class="fa fa-dashboard"></i> <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="AdminCarousel">
            <i class="fa fa-dashboard"></i> <span>Carousel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="UserAccounts">
            <i class="fa fa-dashboard"></i> <span>User Accounts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="UserShops">
            <i class="fa fa-dashboard"></i> <span>Shops</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <?php
          }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div id="modal_cashier" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-header bgm-indigo">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="xbutton">×</span></button>
                  <h4 class="modal-title">Choose Cashier : <transaction class="transaction"></transaction></h4>
              </div>
              <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row">
                          <label class="col-md-3  control-label boldlabel">Cashier Name: </label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon">
                                       <i class="fa fa-calendar"></i>
                                  </span>
                                  <select name="" id="cbo_users" data-error-msg="Supplier is required." required>
                                      <?php foreach($users as $user){ ?>
                                          <option value="<?php echo $user->user_id; ?>"><?php echo $user->full_name; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                    </div>
                  </div>
              </div>

              <div class="modal-footer" >
                  <button id="generatexreading" style="margin-top:5px;" type="button" class="btn btn-primary">Generate
                  </button>
                  <button type="button" style="margin-top:5px;" class="btn bgm-red" data-dismiss="modal">Close
                  </button>
              </div>
          </div>
      </div>
  </div>

  <div id="modal_shopname" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-header bgm-indigo">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="xbutton">×</span></button>
                  <h4 class="modal-title">ShopName</h4>
              </div>
              <div class="modal-body">
                  <form id="frm_shopname">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="form-group">
                              <label style="margin-top:8px;" for="inputEmail1">Current Shop Name  :</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                      <input type="text" class="form-control" value="<?php echo $this->session->shop_name; ?>" disabled>
                              </div>
                          </div>
                           <div class="form-group">
                              <label style="margin-top:8px;" for="inputEmail1">New Shop Name  :</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                      <input type="text" name="shop_name" class="form-control" value="">
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              </form>
              <div class="modal-footer" >
                  <button style="margin-top:5px;" type="button" class="btn btn-primary btn_updateshopname">Save
                  </button>
                  <button type="button" style="margin-top:5px;" class="btn bgm-red" data-dismiss="modal">Close
                  </button>
              </div>
          </div>
      </div>
  </div>