<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Order_model');
        $this->load->model('Order_items_model');
        $this->load->model('Cart_model');
        $this->load->model('Products_model');
        // $this->validate_session();

    }

    public function index()
    {

    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                $m_order = $this->Order_model;
                $user_id=$this->session->user_id;
                $response['data']=$m_order->get_list(
                  'cart.user_id='.$user_id,
                  'cart.*'
                );
                echo json_encode($response);
            break;

            case 'create':

              function replaceCharsInNumber($num, $chars) {
                   return substr((string) $num, 0, -strlen($chars)) . $chars;
              }

                $m_order = $this->Order_model;
                $m_order_items = $this->Order_items_model;
                $m_cart = $this->Cart_model;
                $m_products = $this->Products_model;
                $user_id=$this->session->user_id;
                $m_order->user_id = $user_id;
                $m_order->order_no = rand(10000,99999);
                $m_order->order_address = $this->input->post('order_address', TRUE);
                $m_order->order_date = date('Y-m-d');
                $m_order->order_phonenum = $this->input->post('order_phonenum', TRUE);
                $m_order->shipping_fee = $this->input->post('shippingfee', TRUE);
                $m_order->save();

                $order_id = $m_order->last_insert_id();

                $format = "000000";
                $var = "MVF";
                $temp = replaceCharsInNumber($format, $order_id); //5069xxx
                $orderno = $var.'-'.$temp;

                $m_order->order_no = $orderno;
                $m_order->modify($order_id);

                $product_id = $this->input->post('product_id', TRUE);
                $order_qty = $this->input->post('order_qty', TRUE);
                $order_price = $this->input->post('order_price', TRUE);
                $unit_id = $this->input->post('unit_id', TRUE);
                $i=0;
                foreach($product_id as $prod){
                  $m_order_items->product_id = $prod;
                  $m_order_items->order_qty = $order_qty[$i];
                  $m_order_items->order_price = $order_price[$i];
                  $m_order_items->order_id = $order_id;
                  $m_order_items->unit_id = $unit_id[$i];
                  $m_order_items->save();
                  $m_products->set('qty','qty-'.$order_qty[$i]);
			            $m_products->modify($prod);
                  $i++;
                }

                $m_cart->delete_via_fk($user_id);
                $response['order_id'] = $order_id;
                $response['stat'] = 'success';
                $response['row_added'] = $m_order->get_list($order_id);
                echo json_encode($response);

            break;

            case 'delete':
                $m_order=$this->Order_model;
                $cart_id=$this->input->post('cart_id',TRUE);
                $m_order->delete_via_id($cart_id);

            break;


        }
    }
}
