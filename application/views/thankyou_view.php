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

<section class="hero hero-page gray-bg padding-small">
	<div class="container">
		<div class="row d-flex">
			<div class="col-lg-12 order-2 order-lg-1">
				<h3>Thank you for your order  <?php echo $this->session->user_fullname; ?>.</h3>
				<p class="text-muted">An email is sent to your email address <u><?php echo $this->session->user_name; ?></u></p>
			</div
		</div>
	</div>
</section>

<div class="container cart">

	<div class="sixteen columns">

		<!-- Cart -->

      <form id="frm_order">
			<!-- Item #1 -->
      <?php $ordertotal=0;
				if(count($order_info)!=0){
					?>
				<center>
				<div class="contentprint" style="border:2px solid gray;border-radius:10px;padding:10px;margin:50px;">
						<table style="width:80%">
								<hr>
                <tr>
									<td width="70%"><b>Gerona Marketplace</b></td>
									<td>Ordered By : <b><?php echo $order_info[0]->full_name; ?></b></td>
                </tr>
								<tr>
									<td width="80"><b>Gerona Tarlac</b></td>
									<td>Shipping Address : <b><?php echo $order_info[0]->order_address; ?></b></td>
                </tr>
								<tr>
									<td width="80"></td>
									<td>Date : <b><?php echo $order_info[0]->order_date; ?></b></td>
                </tr>
								<tr>
									<td width="80"></td>
									<td>Receipt #: <b><?php echo $order_info[0]->order_no; ?></b></td>
                </tr>
						</table>
						<hr>
					<table style="width:70%;">

						<tr style="border-bottom:1px solid black;">
							<th>Item</th>
							<th>Unit(Weight)</th>
							<th>Price</th>
							<th>Discount</th>
							<th>Total</th>
						</tr>
					<?php
					foreach($order_info as $row){
	          ?>

	          <tr >
							<td ><a href="#"><?php echo $row->product_name; ?></a></td>
							<td ><?php echo $row->unit_name; ?></td>
	    				<td>₱&nbsp<price class="price"><?php echo $row->price; ?></price></td>
							<td ><?php echo $discount = number_format( (($row->price*$row->unit_id)*$row->disc_decimal),2); ?></td>
	    				<td >₱&nbsp<totalprice class="totalprice"><?php echo $row->order_price-$discount; ?></totalprice></td>
	    			</tr>

						<!-- Apply Coupon Code / Buttons -->

	          <?php
	          $ordertotal += $row->order_price-$discount;
	        }
					$shipping_free=50;
					?>
					<tr style="border-top:1px solid black;">
						<td><b>Shipping Fee</b></td>
						<td><b><?php echo $order_info[0]->shipping_fee; ?></b></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><b>Subtotal</b></td>
						<td><b>₱ <?php echo $ordertotal+$shipping_free; ?></b></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>

					</table>
				</div>
				</center>
					<?php

				}

      ?>


	</div>




</div>

<div class="margin-top-40"></div>



<?php echo $_footer; ?>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>


<!-- Java Script
================================================== -->

<?php echo $_def_js_files; ?>
<script>
$('.printreceipt').click(function(){
  $('.contentprint').printThis({
    debug: false,               // show the iframe for debugging
    importCSS: true,            // import page CSS
    importStyle: true,         // import style tags
    printContainer: true,       // grab outer container as well as the contents of the selector
    loadCSS: ["<?php echo base_url().'/assets/css/style.css'; ?>","<?php echo base_url().'/assets/css/green.css'; ?>"],  // path to additional css file - use an array [] for multiple
    pageTitle: "",              // add title to print page
    removeInline: false,        // remove all inline styles from print elements
    printDelay: 333,            // variable print delay; depending on complexity a higher value may be necessary
    header: null,               // prefix to html
    footer: null,               // postfix to html
    base: false ,               // preserve the BASE tag, or accept a string for the URL
    formValues: true,           // preserve input/form values
    canvas: false,              // copy canvas elements (experimental)
    doctypeString: "",       // enter a different doctype for older markup
    removeScripts: false,       // remove script tags from print content
    copyTagClasses: false       // copy classes from the html & body tag
});
})
</script>
</body>
</html>
