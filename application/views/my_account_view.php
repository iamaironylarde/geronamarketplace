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
		<div id="loginmodal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade overview">
		  <div role="document" class="modal-dialog">
        <div class="modal-content">
          <a href="Index"><button type="button" class="close"><span aria-hidden="true"><i class="icon-close"></i></span></button></a>
        </div>
		    <div class="modal-header">
		     	<headerr style="font-size:13pt;font-weight:bold;">Login your account</headerr>
		    </div>
		    <div class="modal-body" style="padding:40px;">

						<form>
                  <div class="row">
                    <div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">Email Address *</label>
                        <input type="text" name="user_name" placeholder="Enter your email address" required="required" class="form-control">
                      </div>
                    </div>
									</div>
									<div class="row">
										<div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">Password *</label>
                        <input type="password" name="user_pword" placeholder="Enter your password" required="required" class="form-control">
                      </div>
                    </div>
                  </div>
              </form>
					<center>
						<a href="#" class="btn btn-template wide btn_login">Login</a>
						<loginstatus class="loginstatus"></loginstatus>
					</center>
		    </div>
		  </div>
		</div>
    <!-- Javascript files-->
    <?php echo $_def_js_files; ?>
		<script>

			$('#loginmodal').modal({
				backdrop: 'static',
				keyboard: false
			})

			$('#loginmodal').modal('show');

			$('.btn_login').click(function(){
				validateUser().done(function(response){
            if(response.stat=="success"){
        		  $('.loginstatus').html('<p style="color:#27ae60;">'+response.msg+'</p>')
                setTimeout(function(){
										if(response.user_group_id==1){
											// 1 if admin
											window.location.href = "Products";
										}
										if(response.user_group_id==2){
											// 3 is buyer
											window.location.href = "Index";
										}
                },600);
            }
            else{
            	$('.loginstatus').html('<p style="color:#c0392b;">'+response.msg+'</p>')
            }
        	}).always(function(){
							setTimeout(function(){
                	$(".btn_login").html('Login');
            	},800);
        	});

      });

      $('input').keypress(function(evt){
          if(evt.keyCode==13){ $('.btn_login').click(); }
      });

			var validateUser=(function(){

	        var _data={uname : $('input[name="user_name"]').val() , pword : $('input[name="user_pword"]').val()};

		        return $.ajax({
		            "dataType":"json",
		            "type":"POST",
		            "url":"MyAccount/transaction/validate",
		            "data" : _data,
		            "beforeSend": function(){
		                $(".btn_login").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size:12pt;"></i>');
		            }
		        });
		});
		</script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
