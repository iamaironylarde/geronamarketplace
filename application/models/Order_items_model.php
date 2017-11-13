<?php

class Order_items_model extends CORE_Model {
    protected  $table="order_items";
    protected  $pk_id="order_items_id";
    function __construct() {
        parent::__construct();
    }

    function get_bestseller(){

        $sql="SELECT products.product_id,products.product_name,products.image1,products.price, SUM(order_qty) AS TotalQuantity
              FROM order_items
              LEFT JOIN products ON
              products.product_id=order_items.product_id
              GROUP BY product_id
              ORDER BY SUM(order_qty) DESC
              LIMIT 5";

        return $this->db->query($sql)->result();

    }


}
?>
