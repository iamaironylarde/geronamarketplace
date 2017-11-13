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
          <div class="col-md-8 order-2 order-md-1">
            <h1>Shop</h1>
            <p class="lead text-muted">Hello Good day!, Happy Shopping!</p>
          </div>
          <ul class="breadcrumb d-flex justify-content-start justify-content-md-center col-md-4 text-right order-1 order-md-2">
            <li class="breadcrumb-item">Shop</li>

              <?php
                if($singlecat!="search"){

                if(count($product_info)!=0){ ?>
                <li class="breadcrumb-item"><?php echo $product_info[0]->product_type; ?></li>
                <li class="breadcrumb-item"><?php echo $product_info[0]->category; ?></li>

              <?php } } else{ ?>
              <?php ?>
                <li class="breadcrumb-item">Search Result</li>
              <?php }?>
          </ul>
        </div>
      </div>
    </section>
		<main>
      <div class="container">
        <div class="row">
          <!-- Sidebar-->
          <div class="sidebar col-xl-3 col-lg-4 sidebar">
            <div class="block">
              <h6 class="text-uppercase">Meats</h6>
              <ul class="list-unstyled">

                  <?php foreach($product_type as $rowhead){ ?>
                  <li><a href="ProductCategory?product_type_id=<?php echo $rowhead->product_type_id; ?>" class="d-flex justify-content-between align-items-center"><span><?php echo $rowhead->product_type; ?></a>
                    <ul class="list-unstyled">
                      <?php foreach($category as $row){ ?>
                        <?php if($row->product_type_id==$rowhead->product_type_id){ ?>
                          <li><a href="ProductCategory?product_type_id=<?php echo $rowhead->product_type_id; ?>&category=<?php echo $row->category_id; ?>  ">
                            <?php  echo $row->category; } ?></a>
                          </li>
                        <?php } ?>
                    </ul>
                  <?php } ?>

                </li>
              </ul>
            </div>
          </div>
          <!-- /Sidebar end-->
          <!-- Grid -->
          <div class="products-grid col-xl-9 col-lg-8 sidebar-left">

            <div class="row">
              <!-- item-->
							<?php
					      if(count($product_info)==0){ ?>
                  <h3 style="padding:80px;margin:0 auto;">No Result Found</h3>
              <?php
					      }
					      else{ ?>
                  <?php
					      foreach($product_info as $rows){
					    ?>

		          <div class="item col-xl-4 col-md-6">
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
		                    <!-- <a href="javascript:void()" class="quick-view viewtocart"><i class="fa fa-arrows-alt"></i></a> -->

		                  </div>

		                </div>
		              </div>
		              <div class="title"><a href="ProductDetails?getprodinfo=<?php echo $rows->product_id; ?>&category_id=<?php echo $rows->category_id; ?>">
		                  <h3 class="h6 text-uppercase no-margin-bottom"><?php echo $rows->product_name; ?></h3></a><span class="price text-muted">₱ <price class="prodname_price"><?php echo $rows->price; ?></price></span></div>
		            </div>
		          </div>
							<?php
					      }
					      }
					    ?>
            </div>
            <!-- <nav aria-label="page navigation example" class="d-flex justify-content-center">
              <ul class="pagination pagination-custom">
                <li class="page-item"><a href="#" aria-label="Previous" class="page-link"><span aria-hidden="true">Prev</span><span class="sr-only">Previous</span></a></li>
                <li class="page-item"><a href="#" class="page-link active">1       </a></li>
                <li class="page-item"><a href="#" class="page-link">2       </a></li>
                <li class="page-item"><a href="#" class="page-link">3       </a></li>
                <li class="page-item"><a href="#" class="page-link">4       </a></li>
                <li class="page-item"><a href="#" class="page-link">5 </a></li>
                <li class="page-item"><a href="#" aria-label="Next" class="page-link"><span aria-hidden="true">Next</span><span class="sr-only">Next     </span></a></li>
              </ul>
            </nav> -->
          </div>
          <!-- / Grid End-->
        </div>
      </div>
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
        _product_id = $(this).attr('id');
				AddToCartFunc(_product_id).done(function(response){
					window.location.href = "ShoppingCart";
				});
      });

    </script>
  </body>

<!-- Mirrored from hub.ondrejsvestka.cz/1-0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2017 14:03:32 GMT -->
</html>
