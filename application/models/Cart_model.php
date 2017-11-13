<?php

class Cart_model extends CORE_Model {
    protected  $table="cart";
    protected  $pk_id="cart_id";
    protected  $fk_id="user_id";
    function __construct() {
        parent::__construct();
    }




}
?>
