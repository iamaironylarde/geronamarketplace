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

    <!-- Hero Section-->
    <section class="hero hero-page gray-bg padding-small">
      <div class="container">
        <div class="row d-flex">
          <div class="col-lg-9 order-2 order-lg-1">
            <h1>Checkout</h1>
            <p class="lead text-muted">You currently have <?php echo (count($products_cart)==0) ? 'No' : count($products_cart); ?> items in your shopping cart</p>
          </div>
          <ul class="breadcrumb d-flex justify-content-start justify-content-lg-center col-lg-3 text-right order-1 order-lg-2">
            <li class="breadcrumb-item"><a href="Index">Home</a></li>
            <li class="breadcrumb-item active">Shopping Cart</li>
          </ul>
        </div>
      </div>
    </section>
    <!-- Checout Forms-->
    <section class="checkout">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <ul class="nav nav-pills">
              <li class="nav-item"><a href="javascript:void();" class="nav-link active">Address &nbsp -></a></li>
              <li class="nav-item"><a href="javascript:void();" class="nav-link disabled light delmethod">Delivery Method &nbsp -></a></li>
              <li class="nav-item"><a href="javascript:void();" class="nav-link disabled ordermethod">Order Review &nbsp -></a></li>
              <li class="nav-item"><a href="javascript:void();" class="nav-link disabled">Order Placed</a></li>
            </ul>

            <div class="tab-content coladdress">
              <div id="address" class="active tab-block">
                <div class="row">
                    <div class="form-group col-md-6">
                      <input type="radio" id="option1" class="radio-template" checked>
                      <label for="option1"><strong>Primary Address</strong><br><span class="label-description">Your profile address</span></label>
                    </div>
                    <div class="form-group col-md-6">
                      <input type="radio" id="option2" class="radio-template">
                      <label for="option2"><strong>Alternative Address</strong><br><span class="label-description">Alternative delivery address</span></label>
                    </div>
                  </div>
                <form id="checkout_frm">
                  <div class="row primary-address">
                    <div class="form-group col-md-6">
                      <label for="street" class="form-label">Address</label>
                      <input type="text" id="primary_address" value="<?php echo $this->session->user_address; ?>" readonly class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="street" class="form-label">Barangay</label>
                      <input type="text" value="<?php echo $this->session->brgy_name; ?>" readonly class="form-control pr_eta" data-preta="<?php echo $this->session->eta_delivery; ?>">
                      <input type="hidden" id="primary_brgy_id" value="<?php echo $this->session->brgy_id; ?>" readonly class="form-control">
                    </div>
                  </div>
                  <div class="row alternative-address" style="display:none;">
                    <div class="form-group col-md-6">
                      <label for="street" class="form-label">Address</label>
                      <input type="text" id="alt_order_address" value="" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label">Barangay</label>
                      <select class="form-control altbrgy" style="padding:0;" id="alt_brgy_id">
                          <?php foreach($barangay as $brgy){ ?>
                              <option value="<?php echo $brgy->brgy_id; ?>" data-eta="<?php echo $brgy->eta_delivery; ?>">&nbsp&nbsp&nbsp&nbsp<?php echo $brgy->brgy_name; ?></option>
                          <?php  } ?>
                        </select>
                    </div>
                  </div>
                  <p>average delivery time might take <b style="color:#27ae60;" class="etatext"><?php echo $this->session->eta_delivery; ?></b> minutes after the item is shipped.</p>
                <div class="CTAs d-flex justify-content-between flex-column flex-lg-row">
                  <a href="ShoppingCart" class="btn btn-template-outlined wide prev"> <i class="fa fa-angle-left"></i>Back to basket</a>
                  <a href="javascript:void();" class="btn btn-template wide next" id="gotopayment">Choose delivery method<i class="fa fa-angle-right"></i></a></div>
              </div>
            </div>

            <div class="tab-content colopaymentmethod" style="display:none;">
              <div id="payment-method" class="tab-block">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                    <div id="headingOne" role="tab" class="card-header">
                      <h6><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Cash On Delivery</a></h6>
                    </div>
                    <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" class="collapse show">
                      <div class="card-body">
                          <div class="row">
                            <div class="card-body">
                              <input type="radio" name="shippingfee" value="50" id="payment-method-2" class="radio-template" checked>
                              <label for="payment-method-2"><strong>Cash On Delivery</strong><br><span class="label-description">If the purchaser does not make payment when the good is delivered, then the good is returned to the seller.</span></label>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="CTAs d-flex justify-content-between flex-column flex-lg-row">
                  <a href="javascript:void();" class="btn btn-template-outlined wide prev" id="gotoaddress"><i class="fa fa-angle-left"></i>Back to Address</a>
                  <a href="javascript:void();" class="btn btn-template wide next" id="gotosummary">Continue to order review<i class="fa fa-angle-right"></i></a></div>
              </div>
            </div>

            <div class="tab-content colsummary" style="display:none;">
              <div id="order-review" class="tab-block">
                <div class="cart">
                  <div class="cart-holder">
                    <div class="basket-header">
                      <div class="row">
                        <div class="col-4">Product</div>
                        <div class="col-2">Price</div>
                        <div class="col-2">Weight</div>
                        <div class="col-2">Discount</div>
                        <div class="col-2">Unit Price</div>
                      </div>
                    </div>
                    <div class="basket-body">
                      <?php
                  			$ordertotal=0; $shippingfee=50;
                  			foreach($products_cart as $row){
              				?>
                      <input type="hidden" name="product_id[]" value="<?php echo $row->product_id; ?>" readonly/>
            					<input type="hidden" name="order_qty[]" value="<?php echo $row->quantity; ?>"  readonly/>
            					<input type="hidden" name="order_price[]" value="<?php echo $row->price*$row->unit_id; ?>" readonly/>
                      <input type="hidden" name="unit_id[]" value="<?php echo $row->unit_id; ?>" readonly/>
                      <div class="item row d-flex align-items-center">
                        <div class="col-4">
                          <div class="d-flex align-items-center"><img src="<?php echo $row->image1; ?>" alt="..." class="img-fluid">
                            <div class="title"><a href="detail.html">
                                <h6><?php echo $row->product_name; ?></h6><span class="text-muted">Weight: <?php echo $row->unit_name; ?></span></a></div>
                          </div>
                        </div>
                        <div class="col-2"><span>₱ <?php echo number_format($row->price,2); ?></span></div>
                        <div class="col-2"><span><?php echo $row->unit_name; ?></span></div>
                        <div class="col-2"><span>₱&nbsp<?php echo $discount = number_format( (($row->price*$row->unit_id)*$row->disc_decimal),2); ?></span></div>

                        <div class="col-2"><span>₱&nbsp<?php echo number_format( ($row->price*$row->unit_id)-$discount,2); ?></span></div>
                      </div>

                      <?php
                				$ordertotal+=$row->price*$row->unit_id-$discount;
                			}
                			?>
                			</form>
                    </div>
                  </div>
                  <div class="total row"><span class="col-md-10 col-2">Total</span><span class="col-md-2 col-10 text-primary">₱ <?php echo number_format($ordertotal,2); ?></span></div>
                </div>
                <div class="CTAs d-flex justify-content-between flex-column flex-lg-row">
                  <a href="javascript:void();" class="btn btn-template-outlined wide prev" id="gobackpayment"><i class="fa fa-angle-left"></i>Back to payment method</a>
                  <a href="javascript:void();" class="btn btn-template wide next continue">Place an order<i class="fa fa-angle-right"></i></a></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="block-body order-summary">
              <h6 class="text-uppercase">Order Summary</h6>
              <p>Shipping fee is 50 PHP</p>
              <ul class="order-menu list-unstyled">
                <li class="d-flex justify-content-between"><span>Order Subtotal </span><strong>₱ <?php echo number_format($ordertotal,2); ?></strong></li>
                <li class="d-flex justify-content-between"><span>Shipping and handling</span><strong>₱ <?php echo number_format($shippingfee,2); ?></strong></li>
                <li class="d-flex justify-content-between"><span>Total</span><strong class="text-primary price-total">₱ <?php echo number_format($ordertotal+$shippingfee,2); ?></strong></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- <div class="tab-content colthankyou">
          <div class="tab-block">
              <div class="card">
                <h6 class="text-uppercase">Thank you for your order, We appreciate your business</h6>
              </div>
          </div>
        </div> -->
      </div>
    </section>


    <?php echo $_footer; ?>
    <!-- Javascript files-->
    <?php echo $_def_js_files; ?>
    <script>

    var addresstype=1;
    $('#option2').click(function(){
      $('.altbrgy').trigger("change");
      $('.alternative-address').show();
      $('.primary-address').hide();
      $('#option1').prop('checked', false);
      addresstype=2;
    });

    $('#option1').click(function(){
      var pr = $('.pr_eta').attr('data-preta');
      $('.etatext').text(pr);
      $('.alternative-address').hide();
      $('.primary-address').show();
      $('#option2').prop('checked', false);
      addresstype=1;
    });

    $('#gotopayment').click(function(){
      $('.coladdress').hide();
      $('.colopaymentmethod').fadeIn();
      $('.delmethod').removeClass('disabled');
      $('.delmethod').addClass('active');
    });

    $('#gobackpayment').click(function(){
      $('.colsummary').hide();
      $('.colopaymentmethod').fadeIn();
      $('.ordermethod').removeClass('active');
      $('.ordermethod').addClass('disabled');
    });

    $('#gotoaddress').click(function(){
      $('.colopaymentmethod').hide();
      $('.coladdress').fadeIn();
      $('.delmethod').removeClass('active');
      $('.delmethod').addClass('disabled');
    });

    $('#gotosummary').click(function(){
      if(!$('#payment-method-2').is(':checked')){
        return;
      }
      $('.colopaymentmethod').hide();
      $('.colsummary').fadeIn();
      $('.ordermethod').removeClass('disabled');
      $('.ordermethod').addClass('active');
    });

    $('.continue').click(function(){
		Ordernow().done(function(response){
			if(response.stat=="success"){
				window.location.href = "Thankyou?order_id="+response.order_id+" ";
			}
  		}).always(function(){
  		});
    });

    $('.altbrgy').change(function(){
      var _eta = $(this).find('option:selected').attr('data-eta');
      $('.etatext').text(_eta);
    })




	var Ordernow=function(newval){
      var _data=$('#checkout_frm').serializeArray();
      if(addresstype==1){
        _data.push({name : "order_address" ,value : $('#primary_address').val() });
        _data.push({name : "order_city" ,value : $('#primary_brgy_id').val() });
      }
      else{
        _data.push({name : "order_address" ,value : $('#alt_order_address').val() });
        _data.push({name : "order_city" ,value : $('#alt_brgy_id').val() });
      }
      return $.ajax({
          "dataType":"json",
          "type":"POST",
          "url":"Order/transaction/create",
          "data":_data
      });

  };

    </script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
