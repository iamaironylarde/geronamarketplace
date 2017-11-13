<?php

class Products_model extends CORE_Model {
    protected  $table="products";
    protected  $pk_id="product_id";
    function __construct() {
        parent::__construct();
    }

    function get_similaritems($category_id){

        $sql="SELECT * FROM products
              WHERE category_id=".$category_id." AND is_deleted=0
              ORDER BY RAND()
              LIMIT 4";

        return $this->db->query($sql)->result();

    }


}
?>
