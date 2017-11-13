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
    <section class="hero hero-page padding-small">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-8 order-2 order-md-1"></div>
          <ul class="breadcrumb d-flex justify-content-start justify-content-md-center col-md-4 text-right order-1 order-md-2">
            <li class="breadcrumb-item"><a href="ProductCategory">Products</a></li>
						<li class="breadcrumb-item"><?php echo $product_info[0]->product_type; ?></li>
						<li class="breadcrumb-item active"><a href="#/"><?php echo $product_info[0]->category; ?></a></li>
          </ul>
        </div>
      </div>
    </section>
    <section class="product-details no-padding-top">
      <div class="container">
        <div class="row">
          <div class="product-images col-lg-6">
            <div data-slider-id="1" class="owl-carousel items-slider owl-drag">
              <div class="item"><img src="<?php echo $product_info[0]->image1; ?>" alt="shirt"></div>
              <div class="item"><img src="<?php echo $product_info[0]->image2; ?>" alt="shirt"></div>
            </div>
            <div data-slider-id="1" class="owl-thumbs d-flex align-items-center justify-content-center">
              <button class="owl-thumb-item"><img src="<?php echo $product_info[0]->image1; ?>" alt="shirt"></button>
              <button class="owl-thumb-item active"><img src="<?php echo $product_info[0]->image2; ?>" alt="shirt"></button>
            </div>
          </div>
          <div class="details col-lg-6">
            <h2><?php echo $product_info[0]->product_name; ?></h2>
            <div class="d-flex align-items-center justify-content-between flex-column flex-sm-row">
              <ul class="price list-inline no-margin">
                <li class="list-inline-item current">₱ <?php echo number_format($product_info[0]->price,2); ?></li>
              </ul>

            </div>
            <p><?php echo $product_info[0]->product_desc; ?></p>
            <hr>
            <h5><?php echo $product_info[0]->qty; ?> Stock Left</h5>
            <hr>
            <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
<!--               <div class="quantity d-flex align-items-center">
                <div class="dec-btn">-</div>
                <input type="text" value="1" class="quantity-no">
                <div class="inc-btn">+</div>
              </div> -->
              <select class="form-control d_unit_id" style="width:100px;height:50px;">
                <?php foreach($units as $row){ ?>
                  <option value="<?php echo $row->unit_id; ?>"><?php echo $row->unit_name; ?></option>
                <?php } ?>
              </select>
            </div>
            <ul class="CTAs list-inline">
							<?php if($this->session->user_id){ ?>
              <li class="list-inline-item"> <button type="button" class="btn btn-template wide addtocart" ><i class="icon-cart"></i>Add to Cart </button></li>
              <li class="list-inline-item"> <button type="button" class="btn btn-template wide addtoreserve" ><i class="icon-cart"></i>Reserve</button></li>
            </ul>
							<input type="hidden" class="d_productid" value="<?php echo $product_info[0]->product_id; ?>">
							<input type="hidden" class="d_qty" value="<?php echo $product_info[0]->qty; ?>">
						<?php } else { ?>
							<li class="list-inline-item"><a href="MyAccount" class="btn btn-template wide"> <i class="icon-cart"></i>Login to buy Product</a></li></ul>
						<?php } ?>
					</div>
        </div>
      </div>
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


    </section>
    <section class="product-description no-padding">
      <div class="container">
        <ul role="tablist" class="nav nav-tabs">
          <li class="nav-item"><a data-toggle="tab" href="#description" role="tab" class="nav-link active">Description</a></li>
        </ul>
        <div class="tab-content">
          <div id="description" role="tabpanel" class="tab-pane active">
						<p><?php echo $product_info[0]->product_desc; ?></p>

          </div>
          <!-- <div id="additional-information" role="tabpanel" class="tab-pane">
            <ul class="list-unstyled additional-information">
              <li class="d-flex justify-content-between"><strong>Compsition:</strong><span>Cottom</span></li>
              <li class="d-flex justify-content-between"><strong>Styles:</strong><span>Casual</span></li>
              <li class="d-flex justify-content-between"><strong>Properties:</strong><span>Short Sleeve</span></li>
              <li class="d-flex justify-content-between"><strong>Brand:</strong><span>Calvin Klein</span></li>
            </ul>
          </div> -->
        </div>
      </div>


    </section>
    <section class="related-products">
      <div class="container">
        <header class="text-center">
          <h2><small>Similar Items</small>You may also like</h2>
        </header>
        <div class="row">
          <?php foreach($similar_items as $rows){ ?>
          <!-- item-->
          <div class="item col-lg-3">
            <div class="product is-gray">
              <div class="image d-flex align-items-center justify-content-center"><img src="<?php echo $rows->image1; ?>" alt="..." class="img-fluid">
                <div class="hover-overlay d-flex align-items-center justify-content-center">
                  <div class="CTA d-flex align-items-center justify-content-center"><a href="ProductDetails?getprodinfo=<?php echo $rows->product_id; ?>&category_id=<?php echo $rows->category_id; ?>" class="visit-product active"><i class="icon-search"></i>View</a></div>
                </div>
              </div>
              <div class="title"><a href="#">
                  <h3 class="h6 text-uppercase no-margin-bottom"><?php echo $rows->product_name; ?></h3></a><span class="price">₱ <?php echo $rows->price; ?></span></div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </section>

    <?php echo $_footer; ?>

    <?php echo $_shopping_cart; ?>
    <!-- Javascript files-->
    <?php echo $_def_js_files; ?>
    <script>
      $('.viewtocart').click(function(){
        var _product_id=$(this).parent().parent().parent().parent().parent().find('.product_id').val();
        var _product_qty=$(this).parent().parent().parent().parent().parent().find('.product_qty').val();
        var _prodname_name=$(this).parent().parent().parent().parent().parent().find('.product_name').val();
        var _prodname_description=$(this).parent().parent().parent().parent().parent().find('.product_description').val();
        var _prod_price=$(this).parent().parent().parent().parent().parent().find('.product_price').val();
        var _prod_image=$(this).parent().parent().parent().parent().parent().find('.product_image').val();

        $('.modalprodid').val(_product_id);
        $('.modalprodqty').val(_product_qty);
        $('.modalprodname').text(_prodname_name);
        $('.modalproddescription').text(_prodname_description);
        $('.modalprodprice').text('₱ '+_prod_price);
        $('.modalprodimage').attr('src',_prod_image);
        $('#exampleModal').modal('show');

      });

      $('.addtocart').click(function(){
        _product_id = $('.d_productid').val();
        _product_qty = $('.d_qty').val();
        _quantitybuy = $('.d_unit_id').val();
        _unit_id = $('.d_unit_id').val();
        if(_product_qty<_quantitybuy){
          $('.message').text('Out of stock');
          $('#modalcart').modal('show');
          return;
        }
        else{
          AddToCartFunc(_product_id).done(function(response){
            if(response.stat=="error"){
              $('.message').text(response.msg);
              $('#modalcart').modal('show');
              return;
            }
            $('#productnameajax').text(response.row_added[0].product_name);
            $('#imgajax').attr('src',response.row_added[0].image1);
            $('#categoryajax').text(response.row_added[0].category);
            $('#priceajax').text(response.row_added[0].price);
            var currentsubtotal = $('.currentsubtotal').val();
            var newsubtotal = parseInt(response.row_added[0].unit_id)*parseInt(response.row_added[0].price) ;
            $('.newsubtotal').text(newsubtotal+parseInt(currentsubtotal));
            $('.totalpriceajax').text(newsubtotal+50+parseInt(currentsubtotal));
            
            $('#modal_shopping_cart').modal({
                backdrop: 'static',
                keyboard: false
            })

            // window.location.href = "ShoppingCart";
        });
       }

      });

      $('.addtoreserve').click(function(){
        _product_id = $('.d_productid').val();
        _product_qty = $('.d_qty').val();
        _quantitybuy = $('.quantity-no').val();
        _unit_id = $('.d_unit_id').val();
        if(_product_qty<_quantitybuy){
          $('#modalcart').modal('show');
          $(".addtocart").html('<i class="icon-cart"></i>Add to Cart ');
          return;
        }
        else{
          AddToReserve(_product_id).done(function(response){
            window.location.href = "ReserveCart";
        });
       }

      });



      var AddToCartFunc=function(_product_id){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Cart/transaction/create",
            "data":{product_id : _product_id,unit_id : _unit_id },
            "beforeSend": function(){
              $(".addtocart").html('<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Adding to cart...');
          }
        });

      };

      var AddToReserve=function(_product_id){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Cart/transaction/createreserve",
            "data":{product_id : _product_id,unit_id : _unit_id }
        });

      };



    </script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
