<!-- Overview Popup    -->
<div id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade overview">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="icon-close"></i></span></button>
    </div>
    <div class="modal-body">
      <div class="row d-flex align-items-center">
        <input type="hidden" class="modalprodid" value="">
        <input type="hidden" class="modalprodqty" value="">
        <div class="image col-lg-5"><img alt="..." class="img-fluid d-block modalprodimage"></div>
        <div class="details col-lg-7">
          <h2><modalprodname class="modalprodname"></modalprodname></h2>
          <ul class="price list-inline">
            <li class="list-inline-item current"><modalprodprice class="modalprodprice"></modalprodprice></li>
          </ul>
          <p class="modalproddescription"></p>
          <div class="d-flex align-items-center">
            <div class="quantity d-flex align-items-center">
              <div class="dec-btn">-</div>
              <input type="text" value="1" class="quantity-no">
              <div class="inc-btn">+</div>
            </div>
            <select id="size" class="bs-select">
              <option value="small">Small</option>
              <option value="meduim">Medium</option>
              <option value="large">Large</option>
              <option value="x-large">X-Large</option>
            </select>
          </div>
          <ul class="CTAs list-inline">
            <?php if($this->session->user_fullname){ ?>
            <li class="list-inline-item"><a href="javascript:void()" class="btn btn-template wide addtocart"> <i class="fa fa-shopping-cart"></i>Add to Cart</a></li>
            <?php } else{ ?>
            <li class="list-inline-item"><a href="#" class="btn btn-template wide"> <i class="fa fa-shopping-cart"></i>Login to Buy Product</a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="scrollTop"><i class="fa fa-long-arrow-up"></i></div>
<!-- Footer-->
<footer class="main-footer">
  <!-- Service Block-->
  <div class="services-block">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 d-flex justify-content-center justify-content-lg-start">
          <div class="item d-flex align-items-center">
            <div class="icon"><i class="icon-truck"></i></div>
            <div class="text">
              <h6 class="no-margin text-uppercase">Fast shipping &amp; return</h6><span>Fast Shipping only in Town of Gerona</span>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-center">
          <div class="item d-flex align-items-center">
            <div class="icon"><i class="fa fa-cutlery"></i></div>
            <div class="text">
              <h6 class="no-margin text-uppercase">Fresh Foods guarantee</h6><span>Stored in clean environment</span>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-center">
          <div class="item d-flex align-items-center">
            <div class="icon"><i class="icon-headphones"></i></div>
            <div class="text">
              <h6 class="no-margin text-uppercase">09303332343</h6><span>Available Support</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main Block -->
  <div class="main-block">
    <div class="container">
      <div class="row">
        <div class="info col-lg-4">
          <div class="logo">Gerona Marketplace</div>
          <p>The future Marketplace of Gerona.</p>
          <!-- <ul class="social-menu list-inline">
            <li class="list-inline-item"><a href="#" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
            <li class="list-inline-item"><a href="#" target="_blank" title="vimeo"><i class="fa fa-vimeo"></i></a></li>
          </ul> -->
        </div>
        <div class="site-links col-lg-2 col-md-6">
          <h5 class="text-uppercase">Shop</h5>
          <ul class="list-unstyled">
            <li> <a href="ProductCategory?product_type_id=1">Meat</a></li>
            <li> <a href="ProductCategory?product_type_id=2">Vegetables</a></li>
            <li> <a href="ProductCategory?product_type_id=3">Fish</a></li>
          </ul>
        </div>
        <div class="site-links col-lg-2 col-md-6">
          <h5 class="text-uppercase">Marketplace</h5>
          <ul class="list-unstyled">
            <?php if(!$this->session->user_id){ ?>
            <li> <a href="MyAccount">Login</a></li>
            <li> <a href="Register">Register</a></li>
            <?php } else{ ?>
            <li> <a href="ShoppingCart">Shopping Cart</a></li>
            <li> <a href="Profile">My Profile</a></li>
            <li> <a href="MyOrders">My Orders</a></li>
            <?php } ?>
            <li> <a href="Contact">Contact</a></li>
            <li> <a href="About">About</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="copyrights">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="text col-md-6">
          <p>&copy; 2017 <a href="#" target="_blank">Gerona Marketplace </a> All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>
