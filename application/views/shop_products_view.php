<!DOCTYPE html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title><?php echo $_title; ?></title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<?php echo $_def_css_files; ?>


</head>

<body class="boxed">
<div id="wrapper">

<?php echo $_top_navigation; ?>

<!-- Advanced Search Banner
================================================== -->
<section class="woo-search">
	<form method="get" class="search-form" action="#" role="search">

		<div class="woo-search-main">
			<label for="s">Search For The Finest Products:</label>
			<input value="" name="s" id="s" placeholder="e.g. ninja t-shirt" autocomplete="off" type="text">
			<button><i class="fa fa-search"></i></button>
		</div>

		<div class="woo-search-elements clearfix">

			<!-- Variables -->
			<section class="variables">

				<select id="size" name="size">
					<option>Categories</option>
					<option>Bags</option>
					<option>Discounted</option>
					<option>e-books</option>
					<option>Longsleeves</option>
					<option>Shirts</option>
				</select>

				<select id="size" name="size">
					<option>Size</option>
					<option>S</option>
					<option>M</option>
					<option>L</option>
					<option>XL</option>
				</select>

				<select id="color" name="color">
					<option>Color</option>
					<option>Blue</option>
					<option>Green</option>
					<option>Red</option>
				</select>
			</section>

			<div id="price-range">
				<div class="padding-range"><div id="slider-range-alt"></div></div>
				<label for="amount">Price:</label>
				<input type="text" id="amount"/>
			</div>
			<div class="clearfix"></div>

		</div>

	</form>
</section>


<div class="container">

<!-- Sidebar
================================================== -->
	<div class="four columns">

		<!-- Categories -->
		<div class="widget margin-top-0">
			<h3 class="headline">Categories</h3><span class="line"></span><div class="clearfix"></div>

			<ul id="categories">

				<li><a href="#">Accessories <span>(8)</span></a>
					<ul>
						<li><a href="#">Hats <span>(2)</span></a></li>
						<li><a href="#">Bags <span>(2)</span></a></li>
						<li><a href="#">Gloves  <span>(1)</span></a></li>
						<li><a href="#">Belts <span>(3)</span></a></li>

				<li><a href="#">Accessories <span>(8)</span></a>
					<ul>
						<li><a href="#">Hats <span>(2)</span></a></li>
						<li><a href="#">Bags <span>(2)</span></a></li>
						<li><a href="#">Gloves  <span>(1)</span></a></li>
						<li><a href="#">Belts <span>(3)</span></a></li>
					</ul>
				</li>
					</ul>
				</li>

				<li><a href="#">Jewelry <span>(12)</span></a>
					<ul>
						<li><a href="#">Rings <span>(3)</span></a></li>
						<li><a href="#">Necklaces  <span>(2)</span></a></li>
						<li><a href="#">Bracelets <span>(4)</span></a></li>
						<li><a href="#">Watches <span>(3)</span></a></li>
					</ul>
				</li>

				<li><a href="#">Gifts <span>(3)</span></a>
					<ul>
						<li><a href="#">Headphones <span>(1)</span></a></li>
						<li><a href="#">Books  <span>(2)</span></a></li>
						<li><a href="#">Gifts <span>(3)</span></a>
							<ul>
								<li><a href="#">Headphones <span>(1)</span></a></li>
								<li><a href="#">Books  <span>(2)</span></a></li>
								<li><a href="#">Gifts <span>(3)</span></a>
									<ul>
										<li><a href="#">Headphones <span>(1)</span></a></li>
										<li><a href="#">Books  <span>(2)</span></a></li>
										<li><a href="#">Gifts <span>(3)</span></a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<li><a href="#">Men's Wear <span>(14)</span></a>
					<ul>
						<li><a href="#">Denim <span>(3)</span></a></li>
						<li><a href="#">Shirts <span>(4)</span></a></li>
						<li><a href="#">Jackets  <span>(2)</span></a></li>
						<li><a href="#">Suits <span>(3)</span></a></li>
						<li><a href="#">Pants <span>(2)</span></a></li>
					</ul>
				</li>

				<li><a href="#">Women's Wear <span>(20)</span></a>
					<ul>
						<li><a href="#">Denim <span>(2)</span></a></li>
						<li><a href="#">Skirts <span>(3)</span></a></li>
						<li><a href="#">Dresses <span>(5)</span></a></li>
						<li><a href="#">Shirts <span>(4)</span></a></li>
						<li><a href="#">Jumpsuits <span>(4)</span></a></li>
						<li><a href="#">Shoes <span>(2)</span></a></li>
					</ul>
				</li>

				<li><a href="#">Miscellaneous <span>(3)</span></a>
					<ul>
						<li><a href="#">Lamps <span>(1)</span></a></li>
						<li><a href="#">Mugs  <span>(2)</span></a></li>
					</ul>
				</li>

				<li><a href="#">Levels Example <span>(7)</span></a>
					<ul>
						<li><a href="#">Books <span>(1)</span></a></li>
						<li><a href="#">Headphones <span>(6)</span></a>
							<ul>
								<li><a href="#">Open <span>(2)</span></a>
									<ul>
										<li><a href="#">Sennheiser</a></li>
										<li><a href="#">Beyerdynamic</a></li>
									</ul>
								</li>
								<li><a href="#">Closed <span>(4)</span></a>
									<ul>
										<li><a href="#">Beyerdynamic</a></li>
										<li><a href="#">Denon</a></li>
										<li><a href="#">Sennheiser</a></li>
										<li><a href="#">AKG</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>

			</ul>
			<div class="clearfix"></div>

		</div>


	 	<!-- Widget -->
	 	<div class="widget">
	 		<h3 class="headline">Filter By Price</h3><span class="line"></span><div class="clearfix"></div>

			<div id="price-range">
				<div class="padding-range"><div id="slider-range"></div></div>
				<label for="amount">Price:</label>
				<input type="text" id="amount"/>
				<a href="#" class="button color">Filter</a>
			</div>
			<div class="clearfix"></div>
	 	</div>

	</div>


	<!-- Content
	================================================== -->
	<div class="twelve columns">

		<!-- Ordering -->
		<select class="orderby">
			<option>Default Sorting</option>
			<option>Sort by Popularity</option>
			<option>Sort by Newness</option>
		</select>

	</div>

	<!-- Products -->
	<div class="twelve columns products">

		<!-- Product #1 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="mediaholder">
					<a href="variable-product-page.html">
						<img alt="" src="assets/images/shop_item_01.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_01_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="variable-product-page.html">
					<section>
						<span class="product-category">Skirts</span>
						<h5>Brown Mini Skirt</h5>
						<span class="product-price">$79.00</span>
					</section>
				</a>
			</figure>
		</div>


		<!-- Product #2 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="mediaholder">
					<a href="single-product-page.html">
						<img alt="" src="assets/images/shop_item_02.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_02_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="single-product-page.html">
					<section>
						<span class="product-category">Shoes</span>
						<h5>Glory High Shoes </h5>
						<span class="product-price">$99.00</span>
					</section>
				</a>
			</figure>
		</div>


		<!-- Product #3 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="product-discount">SALE</div>
				<div class="mediaholder">
					<a href="variable-product-page.html">
						<img alt="" src="assets/images/shop_item_03.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_03_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="variable-product-page.html">
					<section>
						<span class="product-category">Suits</span>
						<h5>Wool Two-Piece Suit</h5>
						<span class="product-price-discount">$499.00<i>$399.00</i></span>
					</section>
				</a>
			</figure>
		</div>


		<!-- Product #4 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="mediaholder">
					<a href="variable-product-page.html">
						<img alt="" src="assets/images/shop_item_04.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_04_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="variable-product-page.html">
					<section>
						<span class="product-category">Shirts</span>
						<h5>Vintage Stripe Jumper</h5>
						<span class="product-price">$49.00</span>
					</section>
				</a>
			</figure>
		</div>


		<!-- Product #5 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="mediaholder">
					<a href="single-product-page.html">
						<img alt="" src="assets/images/shop_item_05.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_05_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="single-product-page.html">
					<section>
						<span class="product-category">Accessories</span>
						<h5>Vintage Sunglasses</h5>
						<span class="product-price">$29.00</span>
					</section>
				</a>
			</figure>
		</div>


		<!-- Product #6 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="mediaholder">
					<a href="variable-product-page.html">
						<img alt="" src="assets/images/shop_item_06.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_06_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="variable-product-page.html">
					<section>
						<span class="product-category">Shirts</span>
						<h5>Solid Blue Polo Shirt</h5>
						<span class="product-price">$29.00</span>
					</section>
				</a>
			</figure>
		</div>


		<!-- Product #7 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="mediaholder">
					<a href="variable-product-page.html">
						<img alt="" src="assets/images/shop_item_07.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_07_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="variable-product-page.html">
					<section>
						<span class="product-category">Shirts</span>
						<h5>Shirt in Navy Stripe</h5>
						<span class="product-price">$49.00</span>
					</section>
				</a>
			</figure>
		</div>


		<!-- Product #8 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="mediaholder">
					<a href="single-product-page.html">
						<img alt="" src="assets/images/shop_item_08.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_08_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="single-product-page.html">
					<section>
						<span class="product-category">Bags</span>
						<h5>Zip Based Handheld Bag</h5>
						<span class="product-price">$99.00</span>
					</section>
				</a>
			</figure>
		</div>


		<!-- Product #9 -->
		<div class="four shop columns">
			<figure class="product">
				<div class="mediaholder">
					<a href="single-product-page.html">
						<img alt="" src="assets/images/shop_item_09.jpg"/>
						<div class="cover">
							<img alt="" src="assets/images/shop_item_09_hover.jpg"/>
						</div>
					</a>
					<a href="#" class="product-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
				</div>

				<a href="single-product-page.html">
					<section>
						<span class="product-category">Shirts</span>
						<h5>Long Sleeve Check Shirt</h5>
						<span class="product-price">$69.00</span>
					</section>
				</a>
			</figure>
		</div>
		<div class="clearfix"></div>


		<!-- Pagination -->
		<div class="pagination-container">
			<nav class="pagination">
				<ul>
					<li><a href="#" class="current-page">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
				</ul>
			</nav>

			<nav class="pagination-next-prev">
				<ul>
					<li><a href="#" class="prev"></a></li>
					<li><a href="#" class="next"></a></li>
				</ul>
			</nav>
		</div>

	</div>

</div>


<?php echo $_footer; ?>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>


<!-- Java Script
================================================== -->

<?php echo $_def_js_files; ?>

</body>
</html>
