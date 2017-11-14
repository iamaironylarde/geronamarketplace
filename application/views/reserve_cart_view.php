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
            <h1>Reservations</h1>
            <p class="lead text-muted">You currently have <?php echo (count($products_cart1)==0) ? 'No' : count($products_cart1); ?> Reservation</p>
          </div>
          <ul class="breadcrumb d-flex justify-content-start justify-content-lg-center col-lg-3 text-right order-1 order-lg-2">
            <li class="breadcrumb-item"><a href="Index">Home</a></li>
            <li class="breadcrumb-item active">Reservations</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section-->
    <?php if(count($products_cart1)!=0){ ?>
    <section class="shopping-cart">
      <div class="container">
        <div class="basket">
          <div class="basket-holder">
            <div class="basket-header">
              <div class="row">
                <div class="col-3">Product</div>
                <div class="col-1">Weight</div>
                <div class="col-2">Price</div>
                <div class="col-2">Discount</div>
                <div class="col-2">Total</div>
                <div class="col-1 text-center">Action</div>
                <div class="col-1 text-center">Remove</div>
              </div>
            </div>
            <div class="basket-body">
              <!-- Product-->
              <?php $ordertotal=0; $shippingfee=50;
      				if(count($products_cart1)!=0){
                foreach($products_cart1 as $row){?>
              <input type="hidden" name="product_id" value="<?php echo $row->product_id; ?>">
              <input type="hidden" name="unit_id" value="<?php echo $row->unit_id; ?>">
              <div class="item">
                <div class="row d-flex align-items-center">
                  <div class="col-3">
                    <div class="d-flex align-items-center"><img src="<?php echo $row->image1; ?>" alt="..." class="img-fluid">
                      <div class="title"><a href="ProductDetails?getprodinfo=<?php echo $row->product_id; ?>&category_id=<?php echo $row->category_id; ?>">
                          <h5><?php echo $row->product_name; ?></h5><!-- <span class="text-muted">Weight: <?php echo $row->unit_name; ?></span> --></a></div>
                    </div>
                  </div>
                  <div class="col-1"><span><?php echo $row->unit_name; ?></span></div>
                  <div class="col-2"><span>₱ <?php echo number_format($row->price,2); ?></span></div>
                  <div class="col-2"><span>₱&nbsp<?php echo $discount = number_format( (($row->price*$row->unit_id)*$row->disc_decimal),2); ?></span></div>
                  <div class="col-2"><span>₱ <?php echo number_format( ($row->price*$row->unit_id)-$discount,2); ?></span></div>
                  <div class="col-1 text-center"><button cart-id="<?php echo $row->cart_id; ?>" unit-id="<?php echo $row->unit_id; ?>" product-id="<?php echo $row->product_id; ?>" class="btn btn-template buynow">Buy</button></div>
                  <div class="col-1 text-center"><i id="<?php echo $row->product_id; ?>" class="delete fa fa-trash cart-remove"></i></div>
                </div>
              </div>
              <?php $ordertotal += $row->price*$row->quantity; }  } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="CTAs d-flex align-items-center justify-content-center justify-content-md-end flex-column flex-md-row"><a href="ProductCategory?searchitem=" class="btn btn-template-outlined wide">Continue Shopping</a></div>
      </div>
    </section>
    <!-- Order Details Section-->
    <?php } else{ ?>
      <center><h6 style="margin-top:80px;margin-bottom:80px;font-size:16pt;">Awwwww, Your Reservation seems lonely, Do you want it to be happy?, <a href="ProductCategory?searchitem=">Go Reserve for products Now!</a></h6></center>
    <?php } ?>

    <?php echo $_footer; ?>
    <!-- Javascript files-->
    <?php echo $_def_js_files; ?>
     <!-- Modal -->
      <div class="modal fade" id="modalcart" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-footer" style="background-color:#c0392b; !important;border-top:0">
              <button style="color:white;" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <center><h6 class="message">Out of Stock</h6></center>
            </div>
          </div>
        </div>
      </div>
    <script>


    $('.buynow').click(function(){
      _product_id = $(this).attr('product-id');
      _unit_id = $(this).attr('unit-id');
      _cart_id = $(this).attr('cart-id');
      AddToCartFunc(_product_id,_unit_id,_cart_id).done(function(response){
            if(response.stat=="error"){
              $('.message').text(response.msg);
              $('#modalcart').modal('show');
              $(".buynow").html('<i class="icon-cart"></i>Buy ');
              return;
            }

            window.location.href = "ShoppingCart";
        });
    });

    var AddToCartFunc=function(_product_id,_unit_id,_cart_id){
      return $.ajax({
          "dataType":"json",
          "type":"POST",
          "url":"Cart/transaction/createtoreserve",
          "data":{product_id : _product_id,unit_id : _unit_id,cart_id : _cart_id },
          "beforeSend": function(){
            $(".buynow").html('<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>');
        }
      });

    };

    </script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
