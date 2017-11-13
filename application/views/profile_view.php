<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:01:20 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_title; ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <?php echo $_def_css_files; ?>
  </head>
  <body>
    <!-- navbar-->
    <?php echo $_top_navigation; ?>
    <!-- Hero Section-->
    <section class="hero hero-page gray-bg padding-small">
      <div class="container">
        <div class="row d-flex">
          <div class="col-lg-9 order-2 order-lg-1">
            <h1>My Profile</h1>
            <p class="lead text-muted">Account Information </p>
          </div>
          <ul class="breadcrumb d-flex justify-content-start justify-content-lg-center col-lg-3 text-right order-1 order-lg-2">
            <li class="breadcrumb-item"><a href="Index">Home</a></li>
            <li class="breadcrumb-item active">My Profile</li>
          </ul>
        </div>
    </section>

    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="block-body order-summary">
            <h6 class="text-uppercase">My Account</h6>
            <ul class="order-menu list-unstyled">
              <li class="d-flex justify-content-between"><a href="Profile">Profile</a></li>
              <li class="d-flex justify-content-between"><a href="MyOrders">Orders</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9" style="margin-top:15px;margin-bottom:15px;">
          <div class="row">
            <div class="col-md-4">
              <center>
                <img src="<?php if($this->session->user_photo!=""){ echo $this->session->user_photo; } else { ?>assets/img/user.png<?php } ?>" width="200px" height="200px" class="img-responsive" style="border-radius:10px;">
                <input type="file" name="user_imagetmp[]" class="form-control input-text">
                
              </center>
            
            </div>
            <div class="col-md-8">
              <form id="frm_profile" method="POST" action="MyAccount/transaction/update">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="form-label">First Name</label>
                    <input type="hidden" name="user_id" value="<?php echo $this->session->user_id; ?>" class="form-control" >
                    <input type="hidden" name="user_image" id="user_image" value="">
                    <input type="text" name="user_fname" value="<?php echo $this->session->user_fname; ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="form-label">Last Name</label>
                    <input type="text" name="user_lname" value="<?php echo $this->session->user_lname; ?>" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="form-label">Address</label>
                    <input type="text" name="user_address" value="<?php echo $this->session->user_address; ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="form-label">Barangay</label>
                    <select class="form-control" style="padding:0;" name="brgy_id">
                      <option value="<?php echo $this->session->brgy_id; ?>">&nbsp&nbsp&nbsp&nbsp<?php echo $this->session->brgy_name; ?></option>
                      
                      <?php foreach($barangay as $brgy){ 
                        if($this->session->brgy_id!=$brgy->brgy_id){ ?>
                          <option value="<?php echo $brgy->brgy_id; ?>">&nbsp&nbsp&nbsp&nbsp<?php echo $brgy->brgy_name; ?></option>
                        <?php  }
                        } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="form-label">Contact Number</label>
                    <input type="text" name="user_mobile" value="<?php echo $this->session->user_mobile; ?>" class="form-control input-text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="form-label" style="color:white;">Save Changes</label>
                    <button type="submit" class="btn btn-template" style="width:100%;" id="update_profile">Update</button>
                  </div>
                  
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php echo $_footer; ?>
    <!-- Javascript files-->
    <?php echo $_def_js_files; ?>
    <script>
      $('input[name="user_imagetmp[]"]').change(function(event){
          var _files=event.target.files;
          var data=new FormData();
          $.each(_files,function(key,value){
              data.append(key,value);
          });

          // console.log(_files);

          $.ajax({
              url : 'MyAccount/transaction/upload',
              type : "POST",
              data : data,
              cache : false,
              dataType : 'json',
              processData : false,
              contentType : false,
              success : function(response){
                alert(response.path);
                  $('#user_image').val(response.path);
              }
          });

      });
    </script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
