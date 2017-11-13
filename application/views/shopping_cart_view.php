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
            <h1>Shopping Cart</h1>
            <p class="lead text-muted">You currently have <?php echo (count($products_cart)==0) ? 'No' : count($products_cart); ?> items in your shopping cart</p>
          </div>
          <ul class="breadcrumb d-flex justify-content-start justify-content-lg-center col-lg-3 text-right order-1 order-lg-2">
            <li class="breadcrumb-item"><a href="Index">Home</a></li>
            <li class="breadcrumb-item active">Shopping Cart</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section-->
    <?php if(count($products_cart)!=0){ ?>
    <section class="shopping-cart">
      <div class="container">
        <div class="basket">
          <div class="basket-holder">
            <div class="basket-header">
              <div class="row">
                <div class="col-4">Product</div>
                <div class="col-2">Price</div>
                <div class="col-2">Weight</div>
                <div class="col-1">Discount</div>
                <div class="col-2 text-center">Total</div>
                <div class="col-1 text-center">Remove</div>
              </div>
            </div>
            <div class="basket-body">
              <!-- Product-->
              <?php $ordertotal=0; $shippingfee=50;
      				if(count($products_cart)!=0){
                foreach($products_cart as $row){?>
              <div class="item">
                <div class="row d-flex align-items-center">
                  <div class="col-4">
                    <div class="d-flex align-items-center"><img src="<?php echo $row->image1; ?>" alt="..." class="img-fluid">
                      <div class="title"><a href="ProductDetails?getprodinfo=<?php echo $row->product_id; ?>&category_id=<?php echo $row->category_id; ?>">
                          <h5><?php echo $row->product_name; ?></h5><span class="text-muted">Weight: <?php echo $row->unit_name; ?></span></a></div>
                    </div>
                  </div>
                  <div class="col-2"><span>₱ <?php echo number_format($row->price,2); ?></span></div>
                  <div class="col-2">
                    <form method="POST" action="Cart/transaction/update">
                      <input type="hidden" name="cart_id"  value="<?php echo $row->cart_id; ?>">
                      <select class="form-control" name="unit_id" style="width:100px;height:50px;" onchange='this.form.submit()'>
                          <option value="<?php echo $row->unit_id; ?>"><?php echo $row->quantity; ?></option>
                          <?php
                            foreach($unit as $units){
                              ?>
                              <?php if($units->unit_id!=$row->unit_id){ ?>
                                <option value="<?php echo $units->unit_id; ?>"><?php echo $units->unit_name; ?></option>
                              <?php } ?>
                              <?php
                            }
                          ?>
                      </select>
                    </form>
                  </div>
                  <div class="col-1"><span>₱&nbsp<?php echo $discount = number_format( (($row->price*$row->unit_id)*$row->disc_decimal),2); ?></span></div>
                  <div class="col-2 text-center"><span>₱ <?php echo number_format( ($row->price*$row->unit_id)-$discount,2); ?></span></div>
                  <div class="col-1 text-center"><i id="<?php echo $row->cart_id; ?>" class="delete fa fa-trash cart-remove"></i></div>
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
    <section class="order-details no-padding-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
          </div>
          <div class="col-lg-6">
            <div class="block">
              <div class="block-header">
                <h6 class="text-uppercase">Order Summary</h6>
              </div>
              <div class="block-body">
                <ul class="order-menu list-unstyled">
                  <li class="d-flex justify-content-between"><span>Order Subtotal </span><strong>₱ <?php echo number_format($ordertotal,2); ?></strong></li>
                  <li class="d-flex justify-content-between"><span>Shipping and handling</span><strong>₱ <?php echo number_format($shippingfee,2)?></strong></li>
                  <li class="d-flex justify-content-between"><span>Total</span><strong class="text-primary price-total">₱ <?php echo number_format($ordertotal+$shippingfee,2); ?></strong></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-12 text-center CTAs"><a href="Checkout" class="btn btn-template btn-lg wide ptc">Proceed to checkout<i class="fa fa-long-arrow-right"></i></a></div>
        </div>
      </div>
    </section>
    <?php } else{ ?>
      <center><h6 style="margin-top:80px;margin-bottom:80px;font-size:16pt;">Awwwww, Your Cart seems lonely, Do you want it to be happy?, <a href="ProductCategory?searchitem=">Go shop for products Now!</a></h6></center>
    <?php } ?>

    <?php echo $_footer; ?>
    <!-- Javascript files-->
    <?php echo $_def_js_files; ?>
    <script>


    $('.dec-btn').click(function(){
      selected_id = $(this).attr('id');
      _temnewqty = parseInt($(this).next('.quantity-no').val())-1;
      if(_temnewqty<1){
        preventDefault();
      }
      else{
        _newqty = parseInt($(this).next('.quantity-no').val())-1;
        updateCart().done(function(){

          }).always(function(){
            window.location.href = "ShoppingCart";
          });

      }
    });

    $('.inc-btn').click(function(){
      selected_id = $(this).attr('id');
      _newqty = parseInt($(this).prev('.quantity-no').val())+1;
      updateCart().done(function(){

        }).always(function(){
          window.location.href = "ShoppingCart";
        });
    });



    $('.cart-remove').click(function(){
      selected_id = $(this).attr('id');
  		DeletetoCart();
    });

    var updateCart=function(){

	      return $.ajax({
	          "dataType":"json",
	          "type":"POST",
	          "url":"Cart/transaction/update",
	          "data":{cart_id : selected_id ,quantity : _newqty }
	      });

  	};

    var DeletetoCart=function(newval){

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Cart/transaction/delete",
            "data":{cart_id : selected_id }
        });

    };

    </script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
