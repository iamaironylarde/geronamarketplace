<!DOCTYPE html>
<html lang="en">
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
    <section class="hero hero-home no-padding">
      <!-- Hero Slider-->
      <div class="owl-carousel owl-theme hero-slider">
        <?php
            foreach($carousel as $rows){ ?>
        <div style="background: url(<?php echo $rows->carousel_photo; ?>);" class="item d-flex align-items-center has-pattern">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <h1><?php echo $rows->carousel;?></h1>
                <ul class="lead">
                </ul><a href="ProductCategory?searchitem=" class="btn btn-template wide shop-now">Shop Now<i class="icon-bag"> </i></a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </section>
    <!-- Categories Section-->
    <section class="categories">
      <div class="container">
        <header class="text-center">
          <h2 class="text-uppercase"><small>Food</small>Categories</h2>
        </header>
        <div class="row text-left">
          <div class="col-lg-4"><a href="ProductCategory?product_type_id=1">
              <div style="background-size:cover;background-image: url('assets/img/meat.jpg');" class="item d-flex align-items-end">
                <div class="content">
                  <h3 class="h5">Meat</h3>
                </div>
              </div></a>
          </div>
          <div class="col-lg-4"><a href="ProductCategory?product_type_id=2">
              <div style="background-size:cover;background-image: url('assets/img/vege.jpg');" class="item d-flex align-items-end">
                <div class="content">
                  <h3 class="h5">Vegetable</h3>
                </div>
              </div></a>
          </div>
          <div class="col-lg-4"><a href="ProductCategory?product_type_id=3">
              <div style="background-size:cover;background-image: url('assets/img/fish.jpg');" class="item d-flex align-items-end">
                <div class="content">
                  <h3 class="h5">Fish</h3>
                </div>
              </div></a>
          </div>
        </div>
      </div>
    </section>
    <!-- Men's Collection -->
    <section class="men-collection gray-bg">
      <div class="container">
        <header class="text-center">
          <h2 class="text-uppercase">New Products</h2>
        </header>
        <!-- Products Slider-->
        <div class="owl-carousel owl-theme products-slider">
          <!-- item-->
          <?php foreach($products_new as $rows){ ?>
          <div class="item">
            <input type="hidden" class="product_id" value="<?php echo $rows->product_id; ?>">
            <input type="hidden" class="product_qty" value="<?php echo $rows->qty; ?>">
            <input type="hidden" class="product_name" value="<?php echo $rows->product_name; ?>">
            <input type="hidden" class="product_description" value="<?php echo $rows->product_desc; ?>">
            <input type="hidden" class="product_price" value="<?php echo $rows->price; ?>">
            <input type="hidden" class="product_image" value="<?php echo $rows->image1; ?>">
            <div class="product is-gray">
              <div class="image d-flex align-items-center justify-content-center"><img src="<?php echo $rows->image1; ?>" alt="product" class="img-fluid">
                <div class="hover-overlay d-flex align-items-center justify-content-center">
                  <div class="CTA d-flex align-items-center justify-content-center">
                    <a href="ProductDetails?getprodinfo=<?php echo $rows->product_id; ?>&category_id=<?php echo $rows->category_id; ?>" class="visit-product active"><i class="icon-search"></i>View</a>

                  </div>

                </div>
              </div>
              <div class="title"><a href="detail.html">
                  <h3 class="h6 text-uppercase no-margin-bottom"><?php echo $rows->product_name; ?></h3></a><span class="price text-muted">₱ <price class="prodname_price"><?php echo $rows->price; ?></price></span></div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- Divider Section-->
    <section style="background: url(assets/images/divider.jpg);" class="divider">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2 class="h1 text-uppercase no-margin">There's nothing like our fresh goods</h2>
            <p>Only here at Gerona Marketplace</p><a href="ProductCategory?searchitem=" class="btn btn-template wide shop-now">Shop Now<i class="icon-bag"></i></a>
          </div>
        </div>
      </div>
    </section>
    <!-- Women's Collection -->
    <section class="women-collection">
      <div class="container">
        <header class="text-center">
          <h2 class="text-uppercase">Best Sellers</h2>
        </header>
        <!-- Products Slider-->
        <div class="owl-carousel owl-theme products-slider">
          <!-- item-->

          <?php foreach($best_seller as $best){ ?>
          <div class="item">
            <div class="product is-gray">
              <div class="image d-flex align-items-center justify-content-center"><img src="<?php echo $best->image1; ?>" alt="product" class="img-fluid">
                <div class="hover-overlay d-flex align-items-center justify-content-center">
                  <div class="CTA d-flex align-items-center justify-content-center">
                    <a href="ProductDetails?getprodinfo=<?php echo $rows->product_id; ?>&category_id=<?php echo $rows->category_id; ?>" class="visit-product active"><i class="icon-search"></i>View</a>

                  </div>

                </div>
              </div>
              <div class="title"><a href="ProductDetails?getprodinfo=<?php echo $rows->product_id; ?>&category_id=<?php echo $rows->category_id; ?>">
                  <h3 class="h6 text-uppercase no-margin-bottom"><?php echo $best->product_name; ?></h3></a><span class="price text-muted">₱ <price class="prodname_price"><?php echo $best->price; ?></price></span></div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php echo $_footer; ?>
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
        _product_id = $('.modalprodid').val();
        _product_qty = $('.modalprodqty').val();
        _quantitybuy = $('.quantity-no').val();
        if(_product_qty<_quantitybuy){
          alert('Out of Stock');
        }
        else{
          AddToCartFunc(_product_id).done(function(response){
            window.location.href = "ShoppingCart";
          });
        }

      });

      var AddToCartFunc=function(_product_id){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Cart/transaction/create",
            "data":{"product_id" : _product_id }
        });

      };

      $('.outofstock').click(function(){
        alert('Item of out stock');
      });

      $('.logintobuy').click(function(){
        alert('Login To Buy');
      });


      $('.addtocartrow').click(function(){
        alert($(this).attr('id'));
      });

    </script>
  </body>
</html>
