<header class="header" style="border-top:2px solid #3498db;">
	<!-- Tob Bar-->
	<nav class="navbar navbar-expand-lg">
		<div class="search-area">
			<div class="search-area-inner d-flex align-items-center justify-content-center">
				<div class="close-btn"><i class="icon-close"></i></div>
				<form action="ProductCategory" method="GET">
					<div class="form-group">
						<input type="search" name="searchitem" id="search" placeholder="What are you looking for?">
						<button type="submit" class="submit"><i class="icon-search"></i></button>
					</div>
				</form>
			</div>
		</div>
		<div class="container-fluid">
			<!-- Navbar Header  --><a href="Index" class="navbar-brand">Gerona MarketPlace</a>
			<button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
			<!-- Navbar Collapse -->
			<div id="navbarCollapse" class="collapse navbar-collapse">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item"><a href="Index" class="nav-link active">Home</a>
					</li>
					<li class="nav-item"><a href="ProductCategory?searchitem=" class="nav-link">Shop</a>
					</li>

					<li class="nav-item"><a href="Contact" class="nav-link">Contact</a>
					</li>
					<li class="nav-item"><a href="About" class="nav-link">About</a>
					</li>
				</ul>
				<div class="right-col d-flex align-items-lg-center flex-column flex-lg-row">
					<!-- Search Button-->
					<div class="search"><i class="icon-search"></i></div>
					<!-- User Dropdown-->

					<?php
            if($this->session->user_fullname){
					?>
						<div class="user dropdown show"><a id="userdetails" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="icon-profile"></i></a>
							<ul aria-labelledby="userdetails" class="dropdown-menu">
								<li class="dropdown-item"><a href="<?php if($this->session->user_group_id==1){ ?>Products<?php } else { ?>Profile<?php } ?>"><?php if($this->session->user_group_id==1){ ?>Admin Panel<?php } else { ?>Profile<?php } ?></a></li>
								<?php echo ($this->session->user_group_id==2) ? '<li class="dropdown-item"><a href="MyOrders">Orders</a></li>' : '';?>
								<li class="dropdown-item"><a href="ReserveCart">Reservations</a></li>
								<li class="dropdown-divider">     </li>
								<li class="dropdown-item"><a href="MyAccount/Transaction/logout">Logout</a></li>
							</ul>
						</div>
					<?php } else{ ?>
						<div class="user dropdown show"><a href="MyAccount" class="dropdown-toggle">Login</a>
						</div>
						<div class="user dropdown show"><a href="Register" class="dropdown-toggle">Register</a>
						</div>
					<?php } ?>


					<!-- Cart Dropdown-->
					<?php if($this->session->user_id){
					?>
					<div class="cart dropdown show"><a id="cartdetails" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="icon-cart"></i>
							<div class="cart-no"><?php echo (count($products_cart)!=0)? count($products_cart) : ''; ?></div></a><a href="ShoppingCart" class="text-primary view-cart">Edit Cart</a>
						<div aria-labelledby="cartdetails" class="dropdown-menu">
							<!-- cart item-->
							<?php  $ordertotal=0; foreach($products_cart as $row){ ?>
							<div class="dropdown-item cart-product">
								<div class="d-flex align-items-center">
									<div class="img"><img src="<?php echo $row->image1; ?>" alt="..." class="img-fluid"></div>
									<div class="details d-flex justify-content-between">
										<div class="text"> <a href="ProductDetails?getprodinfo=<?php echo $row->product_id; ?>"><strong><?php echo $row->product_name; ?></strong></a><small>Weight: <?php echo $row->quantity; ?> </small><span class="price">₱ <?php echo number_format($row->price,2);?></span></div>
									</div>
								</div>
							</div>
						<?php $ordertotal += $row->price*$row->quantity; } ?>
							<!-- total price-->
							<div class="dropdown-item total-price d-flex justify-content-between"><span>Total</span><strong class="text-primary">₱ <?php echo number_format($ordertotal,2);?></strong>
							<input type="hidden" class="currentsubtotal" value="<?php echo $ordertotal; ?>">
							</div>
							<!-- call to actions-->
							<div class="dropdown-item CTA d-flex"><a href="ShoppingCart" class="btn btn-template wide">Edit Cart</a><a href="Checkout" class="btn btn-template wide">Checkout</a></div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</nav>
</header>
