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
		<div id="resetpassmodal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade overview">
		  <div role="document" class="modal-dialog">
        <div class="modal-content">
          <a href="Index"><button type="button" class="close"><span aria-hidden="true"><i class="icon-close"></i></span></button></a>
        </div>
		    <div class="modal-header">
		     	<headerr style="font-size:13pt;font-weight:bold;">Reset Account Password</headerr>
		    </div>
		    <div class="modal-body" style="padding:40px;">

						<form id="formreset">

                  <div class="row">
                    <div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">New Password*</label>
                        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
                        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                        <input type="password" id="newpassword" name="user_pword" placeholder="New Password" required="required" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="name" class="form-label">Confirm New Password*</label>
                        <input type="password" id="confirmpassword" placeholder="Confirm New Password" required="required" class="form-control">
                      </div>
                    </div>
									</div>
              </form>

					<center>
						<a href="#" class="btn btn-template wide btn_save">Change Password</a>
            
						<loginstatus class="loginstatus"></loginstatus><br>
            <a href="MyAccount" style="display:none;" class="btn btn-template wide btnhome">Login Account Now!</a>
					</center>
		    </div>
		  </div>
		</div>
    <!-- Javascript files-->
    <?php echo $_def_js_files; ?>
		<script>

			$('#resetpassmodal').modal({
				backdrop: 'static',
				keyboard: false
			})

			$('#resetpassmodal').modal('show');

			$('.btn_save').click(function(){
				validateUser().done(function(response){
            if(response.stat=="success"){
        		  $('.loginstatus').html('<p style="color:#27ae60;">'+response.msg+'</p>');
              $(".btn_save").hide();
              $(".btnhome").show();
              $('#formreset').hide();
            }
            else{
            	$('.loginstatus').html('<p style="color:#c0392b;">'+response.msg+'</p>')
            }
        	}).always(function(){
							setTimeout(function(){
                	$(".btn_save").html('Change Password');
            	},800);
        	});

      });

      $('input').keypress(function(evt){

          if(evt.keyCode==13){ event.preventDefault(); $('.btn_save').click(); }
      });

			var validateUser=(function(){

          var _data=$('#formreset').serializeArray();

		        return $.ajax({
		            "dataType":"json",
		            "type":"POST",
		            "url":"ResetAccountPassword/transaction/checktoken",
		            "data" : _data,
		            "beforeSend": function(){
		                $(".btn_save").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size:12pt;"></i>');
		            }
		        });
		});
		</script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
