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
          <div class="col-md-9 order-2 order-md-1">
            <h1>Contact</h1>
          </div>
          <ul class="breadcrumb d-flex justify-content-start justify-content-md-center col-md-3 text-right order-1 order-md-2">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Contact</li>
          </ul>
        </div>
      </div>
    </section>
    <main class="contact-page">
      <!-- Contact page-->
      <section class="contact">
        <div class="container">
          <header>
            <p class="lead">
              Are you curious about something? Gerona Marketplace is here to provide you with more information about our products and goods.
            </p>
          </header>
          <div class="row">
            <div class="col-md-4">
              <div class="contact-icon">
                <div class="icon icon-street-map"></div>
              </div>
              <h3>Address</h3>
              <p>Gerona<br>Tarlac<br><strong>Philippines</strong></p>
            </div>
            <div class="col-md-4">
              <div class="contact-icon">
                <div class="icon icon-support"></div>
              </div>
              <h3>Contact Number</h3>
              <p>Charges in your cellular network may apply during call, we advise you to use the electronic form of communication.</p>
              <p><strong>09303332343</strong></p>
            </div>
            <div class="col-md-4">
              <div class="contact-icon">
                <div class="icon icon-envelope"></div>
              </div>
              <h3>Electronic support</h3>
              <p>Please feel free to write an email to us.</p>
              <ul class="list-style-none">
                <li><strong><a href="mailto:">tsuccsmeat09@gmail.com</a></strong></li>
              </ul>
            </div>
          </div>
        </div>
      </section>
    </main>

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
        _product_id = $('.d_productid').val();
        _product_qty = $('.d_qty').val();
        _quantitybuy = $('.quantity-no').val();
        _unit_id = $('.d_unit_id').val();
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
            "data":{product_id : _product_id,unit_id : _unit_id }
        });

      };



    </script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
