    <!-- jQuery 2.2.3 -->
    <script src="adminassets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="adminassets/bootstrap/js/bootstrap.min.js"></script>
    <script src="adminassets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="adminassets/plugins/datepicker/bootstrap-datepicker.js"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="adminassets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- AdminLTE App -->
    <script src="adminassets/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="adminassets/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="adminassets/dist/js/demo.js"></script>
    <!-- Aicheck -->
    <script src="adminassets/plugins/iCheck/icheck.min.js"></script>

    <script src="adminassets/plugins/blockUI.js"></script>
    <!-- DataTables -->
    <script src="adminassets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="adminassets/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script src="adminassets/plugins/datetimepicker/bootstrap-datetimepicker.js"></script>

            <!-- PNotify -->
    <script type="text/javascript" src="adminassets/plugins/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="adminassets/plugins/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="adminassets/plugins/notify/pnotify.nonblock.js"></script>
            <!-- sweet alert -->
    <script type="text/javascript" src="adminassets/plugins/sweet-alert/sweetalert.min.js"></script>
    <!-- Select2 -->
    <script src="adminassets/select2.full.min.js"></script>
    <!-- print this:) -->
    <script src="adminassets/plugins/printThis.js"></script>
    <!--lightbox -->
    <script src="adminassets/plugins/lightgallery/lib/lightgallery.js"></script>
    <!-- pace -->
    <script src="adminassets/plugins/pace/pace.min.js"></script>

    <script src="adminassets/js/buttons.print.min.js"></script>
    <script src="adminassets/js/dataTables.buttons.min.js"></script>

    <script>
    $( document ).ready(function() {
        $('form').submit(function() {
      return false;
    });
    });

    $(window).load(function() {
        setTimeout(function() {
            $(".loader").fadeOut("slow");
            //alert("aw");

        }, 600);
    })

    function getBgColorHex(elem){
        var color = elem.css('background-color')
        var hex;
        if(color.indexOf('#')>-1){
            //for IE
            hex = color;
        } else {
            var rgb = color.match(/\d+/g);
            hex = '#'+ ('0' + parseInt(rgb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(rgb[1], 10).toString(16)).slice(-2) + ('0' + parseInt(rgb[2], 10).toString(16)).slice(-2);
        }
        return hex;
    }

    function gettextColorHex(elem){
        var color = elem.css('color')
        var hex;
        if(color.indexOf('#')>-1){
            //for IE
            hex = color;
        } else {
            var rgb = color.match(/\d+/g);
            hex = '#'+ ('0' + parseInt(rgb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(rgb[1], 10).toString(16)).slice(-2) + ('0' + parseInt(rgb[2], 10).toString(16)).slice(-2);
        }
        return hex;
    }

    var selectcolor = getBgColorHex($('.navbar'));
    var textcolor = gettextColorHex($('.logo'));
    $('.modal-header').css('background-color',selectcolor);
    $('.btn-primary').css('background-color',selectcolor);
    $('.btn-primary').css('color',textcolor);
    $('.modal-title').css('color',textcolor);
    $('.xbutton').css('color',textcolor);

    if(selectcolor=='#ffffff'){
      $('.box').css('box-shadow','0 1px 1px'+textcolor);
      $('.box').css('border-top','2px solid '+textcolor);
      $('.colorsearch').css('border','1px solid '+textcolor);
      $('.modal-header').css('background-color',textcolor);
      $('.modal-title').css('color',selectcolor);
    }
    else{
        $('.colorsearch').css('border','1px solid '+selectcolor);
        $('.box').css('box-shadow','0 1px 1px'+selectcolor);
        $('.box').css('border-top','2px solid '+selectcolor);
    }

    /*loadder color */
    /*$('.loader').css('background-color',selectcolor);*/


    $('.clearfix li').click(function(){
        var selectcolor = getBgColorHex($('.navbar'));
        var textcolor = gettextColorHex($('.logo'));
        $('.modal-header').css('background-color',selectcolor);
        $('.btn-primary').css('background-color',selectcolor);
        $('.btn-primary').css('color',textcolor);
        $('.modal-title').css('color',textcolor);
        $('.xbutton').css('color',textcolor);
        $('.box').css('box-shadow','0 1px 1px'+selectcolor);
        $('.box').css('border-top','2px solid '+selectcolor);
        if(selectcolor=='#ffffff'){
          $('.box').css('box-shadow','0 1px 1px'+textcolor);
          $('.box').css('border-top','2px solid '+textcolor);
          $('.colorsearch').css('border','1px solid '+textcolor);
          $('.modal-header').css('background-color',textcolor);
          $('.modal-title').css('color',selectcolor);
        }
        else{
            $('.colorsearch').css('border','1px solid '+selectcolor);
            $('.box').css('box-shadow','0 1px 1px'+selectcolor);
            $('.box').css('border-top','2px solid '+selectcolor);
        }


    });

    $('#tbl_ref_patient tbody').delegate('tr', 'click', function() {
            //for printing checkboxes JBPV
            var selectcolor = getBgColorHex($('.navbar'));
            var textcolor = gettextColorHex($('.logo'));
            $('.odd').css('background-color','#eeeeee');
            $('.odd').css('color','#616161');
            $('.even').css('background-color','white');
            $('.even').css('color','#616161');
            if(selectcolor=='#ffffff'){
                $(this).closest("tr").css('background-color',textcolor);
                $(this).closest("tr").css('color',selectcolor);
            }
            else{
                $(this).closest("tr").css('background-color',selectcolor);
                $(this).closest("tr").css('color','white');
            }
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.ref_patient_id;
                _selectedname = data.fullname;
                $('.areasex').text(data.sex);
                $('.areaage').text(data.age);
                $('.areadryweight').text(data.dry_weight);
                $('.areaaddress').text(data.address);
                $('.areabirthdate').text(data.bdate);
                $('.areafullname').text(_selectedname);
                /*alert(_selectedname);*/
                /*alert(_selectedID);*/
                _isChecked = this.checked = true; //for checking if there is any highlighted field

    });

    $('#tbl_ref_patient').bind("contextmenu", function(event) {
        event.preventDefault();
        if(event.which == 3){
            if(_isChecked==true){
                $('.areafullname').text(_selectedname);
                $('#modal_process_type').modal('toggle');
            }
            else{
                notice_notif();
            }
        }
    });

    var showSpinningProgress=function(e){
                $.blockUI({ message: '<img src="adminassets/loader.svg" width="100px" height="100px;"></img><h3 style="color:white;">Saving Changes</h3>',
                    css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: 'none',
                    opacity: 1,
                    zIndex: 20000,
                } });
                $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };

    var showSpinningProgressUpload=function(e){
                $.blockUI({ message: '<img src="adminassets/loader.svg" width="100px" height="100px;"></img><h3 style="color:white;font-family:Segoe UI Light">Uploading Image</h3>',
                    css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: 'none',
                    opacity: 1,
                    zIndex: 20000,
                } });
                $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };

    var showSpinningProgressLOADING=function(e){
                $.blockUI({ message: '<img src="adminassets/loader.svg" width="100px" height="100px;"></img><h3 style="color:white;font-family:Segoe UI Light">Loading Data</h3>',
                    css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: 'none',
                    opacity: 1,
                    zIndex: 20000,
                } });
                $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };


    var validateRequiredFields=function(f){
    var stat=true;
    var pword=$('#user_pword').val();
    var cpword=$('#user_confirm_pword').val();
    $('div.form-group').removeClass('has-error');

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                if($(this).val()==0 || $(this).val()==null){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('.input-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }

                }else{
                if($(this).val()==""){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('.input-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
                if(pword!=cpword){
                    showNotification({title:"Error!",stat:"error",msg:"Pasword Doesnt Match"});
                    $('#password').addClass('has-error');
                    $('#confpassword').addClass('has-error');
                    $('#user_confirm_pword').focus();
                    stat=false;
                    return false;
                }
            }




        });

        return stat;
    };
    </script>
