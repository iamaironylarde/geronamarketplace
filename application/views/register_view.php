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
		<div id="registermodal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade overview">
		  <div role="document" class="modal-dialog">
        <div class="modal-content">
          <a href="Index"><button type="button" class="close"><span aria-hidden="true"><i class="icon-close"></i></span></button></a>
        </div>
		    <div class="modal-header">
		     	<headerr style="font-size:13pt;font-weight:bold;">Register an account</headerr>
		    </div>
		    <div class="modal-body" style="padding:40px;">
          <div class="formarea">
						<form id="frm_register">
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
                        <label for="name" class="form-label">First Name *</label>
                        <input type="text" name="user_fname" placeholder="Enter your first name" required="required" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
										<div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">Last Name *</label>
                        <input type="text" name="user_lname" placeholder="Enter your last name" required="required" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
										<div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">Address *</label>
                        <input type="text" name="user_address" placeholder="Enter your address" required="required" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">Barangay *</label>
                        <select class="form-control" style="padding:0;" name="brgy_id">
                          <?php foreach($barangay as $brgy){ ?>
                              <option value="<?php echo $brgy->brgy_id; ?>">&nbsp&nbsp&nbsp&nbsp<?php echo $brgy->brgy_name; ?></option>
                          <?php  } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
										<div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">Contact # *</label>
                        <input type="text" name="user_mobile" placeholder="Enter your contact" required="required" class="form-control input-text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
										<div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">Password # *</label>
                        <input type="password" id="user_pword" name="user_pword" placeholder="Enter your password" required="required" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
										<div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="form-group">
                        <label for="name" class="form-label">Confirm Password *</label>
                        <input type="password" id="user_pwordtmp" name="user_pwordtmp" placeholder="Confirm your password" required="required" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
										<div class="col-sm-6" style="float: none;  margin: 0 auto;">
                      <div class="validationerrors" style="text-align:center;">
                      </div>
                    </div>
                  </div>

              </form>
					<center>
						<a href="javascript:void();" class="btn btn-template wide btn_create">Register</a>
						<loginstatus class="loginstatus"></loginstatus>
					</center>
          </div>
          <div class="statusmessage" style="display:none;">
              <center>
                <statusmessagehere class="statusmessagehere"></statusmessagehere><br><br>
                <a href="Index" class="btn btn-template wide">Go to Homepage</a>
              </center>
          </div>
          <div class="errormessage" style="display:none;">

              <center>
                <messagehere class="messagehere"></messagehere><br><br>
                <a href="javascript:void();" class="btn btn-template wide btntryagain">Try Again.</a>
              </center>
          </div>
		    </div>
		  </div>
		</div>
    <!-- Javascript files-->
    <?php echo $_def_js_files; ?>
		<script>

			$('#registermodal').modal({
				backdrop: 'static',
				keyboard: false
			})

			$('#registermodal').modal('show');

      $('.btn_create').click(function(){
      	if(validateRequiredFields($('#frm_register'))){
				createUser().done(function(response){
					if(response.stat=="success"){
            $('.formarea').hide();
            $('.statusmessage').show();
            $('.statusmessagehere').html(response.msg);

					}
					if(response.stat=="error"){
            $('.formarea').hide();
            $('.errormessage').show();
            $('.messagehere').html(response.msg);
					}
				}).always(function(){
          setTimeout(function(){
              $(".btn_create").html('Register');
          },800);
				});
      	}
  	});

    $('.btntryagain').click(function(){
      $('.errormessage').hide();
      $('.formarea').show();
    });

      var validateRequiredFields=function(f){
	    var stat=true;
	    var pword=$('#user_pword').val();
	    var cpword=$('#user_pwordtmp').val();
	    $('.input-text').removeClass('has-error');

        $('.input-text').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                if($(this).val()==0 || $(this).val()==null){
                    $(this).closest('.input-text').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }

                }else{
                if($(this).val()==""){
                    $(this).closest('.input-text').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
                if(pword!=cpword){
                    $('#user_pword').addClass('has-error');
                    $('#user_pwordtmp').addClass('has-error');
                    $('#user_pword').focus();
										$('.validationerrors').text("Password doesn't match.");
                    stat=false;
                    return false;
                }
            }




        });

        return stat;
    };

    var createUser=function(){
        var _data=$('#frm_register').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Register/transaction/register",
            "data":_data,
						"beforeSend": function(){
              $(".btn_create").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size:12pt;"></i>');
          	}
        });

    };

		</script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
