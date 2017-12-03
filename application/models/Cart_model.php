<?php

class Cart_model extends CORE_Model {
    protected  $table="cart";
    protected  $pk_id="cart_id";
    protected  $fk_id="user_id";
    function __construct() {
        parent::__construct();
    }


    function getall_reserveproducts($filter){

        $sql="SELECT products.product_name,usershop.shop_name,CONCAT(user_accounts.user_fname,' ',user_accounts.user_lname) as reservedby,cart.*,CONCAT(cart.quantity,' KG') as quantity FROM cart
				LEFT JOIN products ON 
				products.product_id = cart.product_id
				LEFT JOIN user_accounts ON 
                user_accounts.user_id = cart.user_id
                LEFT JOIN user_accounts as usershop ON 
                usershop.user_id = products.created_by
				where is_reserve=1 ".$filter;

        return $this->db->query($sql)->result();

    }



}
?>
