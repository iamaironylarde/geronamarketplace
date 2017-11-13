
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
        Orders
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="Homepage"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tbl_orders" class="table table-bordered table-striped">
                <thead class="tbl-header">
                    <tr>
                        <th >Order #</th>
                        <th >Product Name</th>
                        <th >Quantity</th>
                        <th >Price(PHP)</th>
                        <th >Shipping Fee</th>
                        <th >Discount</th>
                        <th >Unit</th>
                        <th >Status</th>
                        <th >Date Ordered</th>
                        <th >Ordered By</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th >Products Name</th>
                        <th >Product Description</th>
                        <th >Category</th>
                        <th >Price(PHP)</th>
                        <th >Shipping Fee</th>
                        <th >Discount</th>
                        <th >Unit</th>
                        <th >Status</th>
                        <th >Date Ordered</th>
                        <th >Ordered By</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
        </div>

    <!--modal-->

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

        dt=$('#tbl_orders').DataTable({
            dom: 'rBfrtip',
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                columns: [ 0, 1, 2,3,4,5,6,8,9 ]
            },
            title: "Orders list",
            customize: function ( win ) {
                      $(win.document.body)
                          .css( 'font-size', '8pt' );

                      $(win.document.body).find( 'table' )
                          .addClass( 'compact' )
                          .css( 'font-size', 'inherit' );
                  }
                }
            ],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax" : "Orders/transaction/list",
            "columns": [
                { targets:[0],data: "order_no" },
                { targets:[1],data: "product_name" },
                { targets:[2],data: "order_qty" },
                { targets:[3],data: "order_price" },
                { targets:[4],data: "shipping_fee" },
                { targets:[5],data: "discount_desc" },
                { targets:[6],data: "unit_name" },
                { targets:[7],data: "order_status_name" },
                { targets:[8],data: "order_date"},
                { targets:[9],data: "ordered_by"},
                { targets:[10],data: "order_date",
                    render: function (data, type, full, meta){
                      var _shipped='<button class="btn btn-success btn-xs" name="shipped" style="margin:2px;" data-toggle="tooltip" data-placement="top">Shipped </button>';
                      var _processing='<button class="btn btn-primary btn-xs" name="processing" data-toggle="tooltip" data-placement="top">Processing </button>';
                      var _cancelled='<button class="btn btn-danger btn-xs" name="cancelled" style="margin:2px;" data-toggle="tooltip" data-placement="top">Cancelled </button>';

                      return '<center>'+_shipped+_processing+_cancelled+'</center>';
                    }
                }

            ],
            language: {
                         searchPlaceholder: "Search Orders"
                     },
        });

    }();


    $(".numeric").autoNumeric('init');

    $('#tbl_orders tbody').on('click','button[name="shipped"]',function(){
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.order_items_id;
        _selectedStat=1;
        ChangeStat().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $.unblockUI();
                    });
    });

    $('#tbl_orders tbody').on('click','button[name="processing"]',function(){
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.order_items_id;
        _selectedStat=2;
        ChangeStat().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $.unblockUI();
                    });
    });

    $('#tbl_orders tbody').on('click','button[name="cancelled"]',function(){
        _selectRowObj=$(this).closest('tr');
        var data=dt.row(_selectRowObj).data();
        _selectedID=data.order_items_id;
        _selectedStat=3;
        ChangeStat().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $.unblockUI();
                    });
    });
    var ChangeStat=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Orders/transaction/changestat",
            "data":{order_items_id : _selectedID,order_status_id : _selectedStat},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var showNotification=function(obj){
        PNotify.removeAll();
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };



 </script>
</body>
</html>
