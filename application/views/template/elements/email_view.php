<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Gerona Marketplace</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<center>
  <h4>Hi,<?php echo $order_info[0]->full_name; ?></h4>
  <p>Thank you for your order - we hope you had a good time shopping with us.</p>
<div class="contentprint" style="border:2px solid gray;border-radius:10px;padding:10px;margin:50px;width:50%;">

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
      <th align="left">Item</th>
      <th align="left">Unit</th>
      <th align="left">Price</th>
      <th align="left">Quantity</th>
      <th align="left">Discount</th>
      <th align="left">Total</th>
    </tr>
  <?php $ordertotal=0;
  foreach($order_info as $row){
    ?>

    <tr >
      <td ><a href="#"><?php echo $row->product_name; ?></a></td>
      <td ><?php echo $row->unit_name; ?></td>
      <td>&#8369; <price class="price"><?php echo $row->price; ?></price></td>
      <td ><?php echo $row->order_qty; ?></td>
      <td ><?php echo $row->discount_desc; ?></td>
      <td >&#8369;<totalprice class="totalprice"><?php echo $row->order_price; ?></totalprice></td>
    </tr>

    <!-- Apply Coupon Code / Buttons -->

    <?php
    $ordertotal += $row->order_price;
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
    <td><b>&#8369; <?php echo $ordertotal+$shipping_free; ?></b></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>

  </table>
</div>
</center>
</html>
