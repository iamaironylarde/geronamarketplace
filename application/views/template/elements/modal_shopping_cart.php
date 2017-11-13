<style>
.product .image{
  padding:0px;
  height:180px;

}
</style>
<div class="modal fade" id="modal_shopping_cart" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-footer" style="background-color:#27ae60; !important;border-top:0">
        <button style="color:white;" type="button" class="close" onClick="window.location.reload()">&times;</button>
      </div>
      <div class="modal-body" style="padding:0;">
        <div class="row">
          <div class="col-md-6" style="border-right:1px solid gray;">
            <div class="container" style="margin-top:20px;">
              <strong style="color:#72b656;">1 new item has been added to your cart</strong>
              <div class="row">
                <div class="col-md-6">
                  <center><img id="imgajax" src="" style="max-width:100%;height:auto;"></img></center>
                </div>
                <div class="col-md-6">
                  <p style="margin:0;margin-top:10px;" id="productnameajax"> </p>
                  <p style="margin:0;" id="categoryajax"> </p>
                  <p style="margin:0;" id="priceajax"> </p>
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="container" style="margin-top:20px;">
              <strong>My Shopping Cart (<?php echo (count($products_cart)!=0)? count($products_cart) : ''; ?> items)
              <a href="ShoppingCart">Edit</a>
              </strong>
              <div class="row">
                <div class="col-md-6">
                <strong>Subtotal:</strong>
                </div>
                <div class="col-md-6">
                ₱ <strong class="newsubtotal"></strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                <strong>Shipping Fee:</strong>
                </div>
                <div class="col-md-6">
                  <strong>₱ 50</strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                <strong>Total:</strong>
                </div>
                <div class="col-md-6">
                  ₱<strong class="totalpriceajax"></strong>
                </div>

                <div class="col-md-12">
                <hr>
                  <center><a href="Checkout" class="btn btn-template btn-lg medium">Proceed to checkout<i class="fa fa-long-arrow-right"></i></a></center>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
            <div class="container" style="margin:40px;margin-top:7px;">
              <header class="text-center">
                <h5>People Who Bought This Item Also Bought</h5>
              </header>
              <hr>
              <div class="row">
                <?php foreach($similar_items as $rows){ ?>
                <!-- item-->
                <div class="item col-lg-3" >
                  <div class="product is-gray">
                    <div class="image d-flex align-items-center justify-content-center"><img src="<?php echo $rows->image1; ?>" alt="..." class="img-fluid" style="width:120px;">
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
        </div>
      </div>
    </div>
  </div>
</div>
