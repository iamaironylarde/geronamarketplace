
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $_title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php echo $_def_css_files ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php echo $_top_navigation; ?>
    <?php echo $_side_navigation; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Carousel
        <small>Reference</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="Homepage"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Carousel</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header" style="">
              <button class="btn btn-primary " id="btn_new"><i class="fa fa-tags" aria-hidden="true"></i> New Carousel</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tbl_carousel" class="table table-bordered table-striped">
                <thead class="tbl-header">
                    <tr>
                        <th style="width:100px !important;">Carousel Photo</th>
                        <th>Carousel Name</th>
                        <th><center><div style="margin-left:20px;">Action</div></center></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="width:100px !important;">Carousel Photo</th>
                        <th>Carousel Name</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
        </div>

    <!--modal-->
        <div id="modal_carousel" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bgm-indigo">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="xbutton">×</span></button>
                        <h4 class="modal-title">Carousel : <transaction class="transaction"></transaction></h4>
                    </div>
                    <div class="modal-body">
                        <form id="frm_carousel">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Carousel Name  :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags fa-size" aria-hidden="true"></i></span>
                                            <input type="text" name="carousel" class="form-control" placeholder="Carousel Name" data-error-msg="Carousel Name is required." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Image 1  :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags fa-size" aria-hidden="true"></i></span>
                                            <input type="file" class="form-control" name="carousel_photo[]" >
                                            <input type="file" name="carousel_phototmp" style="display: none;">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    </form>
                    <div class="modal-footer" >
                        <button id="btn_create" style="margin-top:5px;" type="button" class="btn btn-primary">Save
                        </button>
                        <button type="button" style="margin-top:5px;" class="btn bgm-red" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2017 <a href="#">Gerona Marketplace</a>.</strong> All rights
    reserved.
  </footer>

<?php echo $_right_navigation ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php echo $_def_js_files ?>
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        var img1; var img2; var img3;
        var initializeControls=function(){
        dt=$('#tbl_carousel').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax" : "AdminCarousel/transaction/list",
            "columns": [
                { targets:[0],data: "carousel_photo",
                    render: function (data, type, full, meta){
                            var _carouselphoto='<center><img width="100%" height="100%" src="'+data+'"></center>';

                          return '<center>'+_carouselphoto+'</center>';
                        }

                },
                { targets:[1],data: "carousel" },
                { targets:[2],data: "is_active",
                    render: function (data, type, full, meta){
                        if(data==1){
                            var _view='<button class="btn btn-xs" name="changestat" data-toggle="tooltip" data-placement="top" title="Set as inactive"><i class="fa fa-eye"></i> </button>';
                        }
                        else{
                            var _view='<button class="btn btn-xs" name="changestat" data-toggle="tooltip" data-placement="top" title="Set as Active"><i class="fa fa-eye-slash"></i> </button>';
                        }
                            var _delete='<button class="btn btn-primary btn-xs" name="edit_info" style="margin:2px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                            var _edit='<button class="btn btn-danger btn-xs" name="remove_info" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                      return '<center>'+_view+_delete+_edit+'</center>';
                    }
                }


            ],
            language: {
                         searchPlaceholder: "Search Carousel"
                     },
        });

    }();


    $('#btn_new').click(function(){
        _txnMode="new";
        $('.transaction').text('New');
        $('#modal_carousel').modal('show');
        clearFields($('#frm_carousel'));
    });

    $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_carousel'))){
                if(_txnMode==="new"){
                    //alert("aw");
                    createCarousel().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_carousel'))
                    }).always(function(){
                        $('#modal_carousel').modal('hide');
                        $.unblockUI();
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    //alert("update");
                    updateCarousel().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_carousel').modal('hide');
                        $.unblockUI();
                    });
                    return;
                }
            }
            else{}
        });

    $('#tbl_carousel tbody').on('click','button[name="edit_info"]',function(){
        _txnMode="edit";
        $('.transaction').text('Edit');
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.carousel_id;
        img1=data.carousel_photo;
        
        $('input,textarea').each(function(){
            var _elem=$(this);
            $.each(data,function(name,value){
                if(_elem.attr('name')==name){
                    _elem.val(value);
                }
            });
        });

        $('#modal_carousel').modal('toggle');

    });

    $('#tbl_carousel tbody').on('click','button[name="remove_info"]',function(){
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.carousel_id;
        delete_notif();

    });

    $('#tbl_carousel tbody').on('click','button[name="changestat"]',function(){
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.carousel_id;
        _selectedStat=data.is_active;
        ChangeStat().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_carousel').modal('hide');
                        $.unblockUI();
                    });
    });



    var createCarousel=function(){
        var _data=$('#frm_carousel').serializeArray();
        _data.push({name : "carousel_photo" ,value : img1 });

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"AdminCarousel/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });

    };

    var updateCarousel=function(){
            var _data=$('#frm_carousel').serializeArray();
            _data.push({name : "carousel_id" ,value : _selectedID });
            _data.push({name : "carousel_photo" ,value : img1 });
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"AdminCarousel/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

    var removeCarousel=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"AdminCarousel/transaction/delete",
            "data":{carousel_id : _selectedID},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var ChangeStat=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"AdminCarousel/transaction/changestat",
            "data":{carousel_id : _selectedID,is_active : _selectedStat},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var delete_notif=function(type){
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this file!",
                    type: "warning",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                },function(isConfirm){
                    if (isConfirm) {
                            removeCarousel().done(function(response){
                            showNotification(response);
                                dt.row(_selectRowObj).remove().draw();
                           $.unblockUI();
                            });

                    } else {
                        swal("Cancelled", "Your file is safe :)", "error");
                    }
                });
    };

    var success_notif=function(type){
        swal("Good job!", "Sucessfully "+type, "success");
    };

    var showNotification=function(obj){
        PNotify.removeAll();
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };

    var clearFields=function(f){
        $('input,textarea',f).val('');
        $(f).find('input:first').focus();
    };

    $('.date-picker').datepicker({
      autoclose: true
    });

    $('input[name="carousel_photo[]"]').change(function(event){
        showSpinningProgressUpload();
        var _files=event.target.files;
        var data=new FormData();
        $.each(_files,function(key,value){
            data.append(key,value);
        });

        // console.log(_files);

        $.ajax({
            url : 'AdminCarousel/transaction/upload',
            type : "POST",
            data : data,
            cache : false,
            dataType : 'json',
            processData : false,
            contentType : false,
            success : function(response){
                //console.log(response);
                // alert(response.path);
                img1=response.path;
                $.unblockUI();
            }
        });

    });

 </script>
</body>
</html>
