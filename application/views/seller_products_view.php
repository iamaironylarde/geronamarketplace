
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $_title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php echo $_def_css_files ?>

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
        Products
        <small>Reference</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="Homepage"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Products</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header" style="">
              <button class="btn btn-primary " id="btn_new"><i class="fa fa-tags" aria-hidden="true"></i> New Products</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tbl_products" class="table table-bordered table-striped">
                <thead class="tbl-header">
                    <tr>
                        <th style="width:100px !important;">Product Photo</th>
                        <th >Product Name</th>
                        <th >Product Description</th>
                        <th >Category</th>
                        <th >Price(PHP)</th>
                        <th >Qty Left</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th >Product Photo</th>
                        <th >Products Name</th>
                        <th >Product Description</th>
                        <th >Category</th>
                        <th >Price(PHP)</th>
                        <th >Qty Left</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
        </div>

    <!--modal-->
        <div id="modal_products" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bgm-indigo">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="xbutton">×</span></button>
                        <h4 class="modal-title">Products : <transaction class="transaction"></transaction></h4>
                    </div>
                    <div class="modal-body">
                        <form id="frm_products">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Product Name  :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                                            <input type="text" name="product_name" class="form-control" placeholder="Products Name" data-error-msg="Products Name is required." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Product Description  :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><b>Desc.</b></span>
                                            <textarea name="product_desc" rows="5" class="form-control" data-error-msg="Products Description is required." required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Category  :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-columns" aria-hidden="true"></i></span>
                                            <select name="category_id" class="form-control" data-error-msg="Category is required." required>
                                                  <?php foreach($category as $row){ ?>
                                                      <option value="<?php echo $row->category_id; ?>"><?php echo $row->category; ?></option>
                                                  <?php } ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Price :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags fa-size" aria-hidden="true"></i></span>
                                            <input type="text" name="price" class="form-control numeric" placeholder="Price is required" data-error-msg="Price is required." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Qty :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><b>Qty.</b></span>
                                            <input type="text" name="qty" class="form-control numeric" placeholder="Price is required" data-error-msg="Price is required." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Image 1  :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                                            <input type="file" class="form-control" name="image1[]" >
                                            <input type="file" name="image1tmp" style="display: none;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">Image 2  :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                                            <input type="file" class="form-control" name="image2[]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="margin-top:8px;" for="inputEmail1">New Product?  :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                            <select name="is_newproduct" class="form-control" data-error-msg="This field is required." required>
                                                      <option value="1">Yes</option>
                                                      <option value="0">No</option>
                                            </select>
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
<script src="adminassets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="adminassets/plugins/formatter/accounting.js" type="text/javascript"></script>

    <script type="text/javascript">
        var img1; var img2; var img3;
        var initializeControls=function(){

        dt=$('#tbl_products').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax" : "Products/transaction/list",
            "columns": [
                { targets:[0],data: "image1",
                    render: function (data, type, full, meta){
                            var _prodphoto='<center><img width="100%" height="100%" src="'+data+'"></center>';

                          return '<center>'+_prodphoto+'</center>';
                        }

                },
                { targets:[1],data: "product_name" },
                { targets:[2],data: "product_desc" },
                { targets:[3],data: "category" },
                { targets:[4],data: "price" },
                { targets:[5],data: "qty" },
                { targets:[6],data: "is_newarrival",
                    render: function (data, type, full, meta){
                        if(data==1){
                            var _view='<button class="btn btn-xs" name="changestat" data-toggle="tooltip" data-placement="top" title="Unset as New Product"><i class="fa fa-eye"></i> </button>';
                        }
                        else{
                            var _view='<button class="btn btn-xs" name="changestat" data-toggle="tooltip" data-placement="top" title="Set as New Product"><i class="fa fa-eye-slash"></i> </button>';
                        }
                            var _delete='<button class="btn btn-primary btn-xs" name="edit_info" style="margin:2px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                            var _edit='<button class="btn btn-danger btn-xs" name="remove_info" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                      return '<center>'+_view+_delete+_edit+'</center>';
                    }
                }


            ],
            language: {
                         searchPlaceholder: "Search Products"
                     },
        });

    }();


    $('#btn_new').click(function(){
        _txnMode="new";
        $('.transaction').text('New');
        $('#modal_products').modal('show');
        clearFields($('#frm_products'));
    });

    $(".numeric").autoNumeric('init');

    $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_products'))){
                if(_txnMode==="new"){
                    //alert("aw");
                    createProducts().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_products'))
                    }).always(function(){
                        $('#modal_products').modal('hide');
                        $.unblockUI();
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    //alert("update");
                    updateProducts().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                        clearFields($('#frm_products'));
                    }).always(function(){
                        $('#modal_products').modal('hide');
                        $.unblockUI();
                    });
                    return;
                }
            }
            else{}
        });

    $('#tbl_products tbody').on('click','button[name="edit_info"]',function(){
        _txnMode="edit";
        $('.transaction').text('Edit');
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.product_id;
        img1=data.image1;
        img2=data.image2;

        $('input,textarea').each(function(){
            var _elem=$(this);
            $.each(data,function(name,value){
                if(_elem.attr('name')==name){
                    _elem.val(value);
                }
            });
        });

        $('#modal_products').modal('toggle');

    });

    $('#tbl_products tbody').on('click','button[name="remove_info"]',function(){
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.product_id;
        delete_notif();

    });

    $('#tbl_products tbody').on('click','button[name="changestat"]',function(){
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.product_id;
        _selectedStat=data.is_newarrival;
        ChangeStat().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_carousel').modal('hide');
                        $.unblockUI();
                    });
    });

    var createProducts=function(){
        var _data=$('#frm_products').serializeArray();
        _data.push({name : "image1" ,value : img1 });
        _data.push({name : "image2" ,value : img2 });

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Products/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });

    };

    var updateProducts=function(){
            var _data=$('#frm_products').serializeArray();
            _data.push({name : "product_id" ,value : _selectedID });
            _data.push({name : "image1" ,value : img1 });
            _data.push({name : "image2" ,value : img2 });

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Products/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

    var removeProducts=function(){
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Products/transaction/delete",
                "data":{product_id : _selectedID},
                "beforeSend": showSpinningProgress($('#'))
            });
        };

    var ChangeStat=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Products/transaction/changestat",
            "data":{product_id : _selectedID,is_newarrival : _selectedStat},
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
                            removeProducts().done(function(response){
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

    $('input[name="image1[]"]').change(function(event){
        showSpinningProgressUpload();
        var _files=event.target.files;
        var data=new FormData();
        $.each(_files,function(key,value){
            data.append(key,value);
        });

        // console.log(_files);

        $.ajax({
            url : 'Products/transaction/upload',
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

    $('input[name="image2[]"]').change(function(event){
        showSpinningProgressUpload();
        var _files=event.target.files;
        var data=new FormData();
        $.each(_files,function(key,value){
            data.append(key,value);
        });

        // console.log(_files);

        $.ajax({
            url : 'Products/transaction/upload',
            type : "POST",
            data : data,
            cache : false,
            dataType : 'json',
            processData : false,
            contentType : false,
            success : function(response){
                //console.log(response);
                // alert(response.path);
                img2=response.path;
                $.unblockUI();
            }
        });

    });




 </script>
</body>
</html>
