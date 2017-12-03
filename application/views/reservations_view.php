
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
        Reservations
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="Homepage"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Reservations</li>
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
                        <th >Products Name</th>
                        <th >Weight</th>
                        <th >Shop Name</th>
                        <th >Reserved By</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th >Products Name</th>
                        <th >Weight</th>
                        <th >Shop Name</th>
                        <th >Reserved By</th>
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
                columns: [ 0, 1, 2 ]
            },
            title: "Reservations list",
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
            "ajax" : "Cart/transaction/getallreservations",
            "columns": [
                { targets:[0],data: "product_name" },
                { targets:[1],data: "quantity" },
                { targets:[1],data: "shop_name" },
                { targets:[2],data: "reservedby" }

            ],
            language: {
                         searchPlaceholder: "Search Reservations"
                     },
        });

    }();


    $(".numeric").autoNumeric('init');



 </script>
</body>
</html>
