<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Cart_model');
        // $this->load->model('Users_model');
        // $this->load->model('Wall_post_model');
        // $this->validate_session();

    }

    public function index()
    {

    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                $m_cart = $this->Cart_model;
                $user_id=$this->session->user_id;
                $response['data']=$m_cart->get_list(
                  'cart.user_id='.$user_id,
                  'cart.*'
                );
                echo json_encode($response);
            break;

            case 'create':
                $m_cart = $this->Cart_model;
                $user_id=$this->session->user_id;
                $product_id = $this->input->post('product_id', TRUE);
                $unit_id = $this->input->post('unit_id', TRUE);
                $temp = $m_cart->get_list(
                  'cart.user_id='.$user_id.'  AND cart.is_reserve=0 AND product_id='.$product_id,
                  'cart.cart_id,cart.quantity'
                );
                if(count($temp)==0){
                  $m_cart->user_id = $this->session->user_id;
                  $m_cart->product_id = $this->input->post('product_id', TRUE);
                  $m_cart->unit_id = $this->input->post('unit_id', TRUE);
                  // if($this->input->post('quantity', TRUE)!=null){
                  $m_cart->quantity = $this->input->post('unit_id', TRUE);
                  // }
                  // else{
                  //   $m_cart->quantity = 1;
                  // }

                  $m_cart->save();
                  $cart_id = $m_cart->last_insert_id();
                  $response['stat'] = 'success';
                    $response['row_added'] = $m_cart->get_list($cart_id,
                    'products.*,category.*,cart.unit_id',
                    array(
                          array('products','products.product_id=cart.product_id','left'),
                          array('category','category.category_id=products.category_id','left'),
                      )
                    );
                  echo json_encode($response);
                }
                else{
                  $cart_id = $temp[0]->cart_id;
                  $qtytemp = $temp[0]->quantity;
                  $m_cart->user_id = $this->session->user_id;
                  $m_cart->product_id = $this->input->post('product_id', TRUE);

                  $totalweightqty= $qtytemp + $this->input->post('unit_id', TRUE);
                  $m_cart->quantity = $totalweightqty;
                  if($totalweightqty>9){
                    $response['stat'] = 'error';
                    $response['msg'] = "Max Weight Must be 9KG or less.";
                    echo json_encode($response);
                  }
                  else{
                    $m_cart->unit_id = $totalweightqty;
                    $m_cart->modify($cart_id);
                    $response['stat'] = 'success';
                    $response['row_added'] = $m_cart->get_list($cart_id,
                      'products.*,category.*,cart.unit_id',
                      array(
                            array('products','products.product_id=cart.product_id','left'),
                            array('category','category.category_id=products.category_id','left'),
                        )
                      );
                    echo json_encode($response);
                  }


                }






            break;

            case 'createreserve':
                $m_cart = $this->Cart_model;
                $user_id=$this->session->user_id;
                $product_id = $this->input->post('product_id', TRUE);
                $unit_id = $this->input->post('unit_id', TRUE);
                $temp = $m_cart->get_list(
                  'cart.user_id='.$user_id.' AND cart.is_reserve=1 AND product_id='.$product_id.' AND unit_id='.$unit_id,
                  'cart.cart_id,cart.quantity'
                );
                if(count($temp)==0){
                  $m_cart->user_id = $this->session->user_id;
                  $m_cart->product_id = $this->input->post('product_id', TRUE);
                  $m_cart->unit_id = $this->input->post('unit_id', TRUE);
                  $m_cart->is_reserve = 1;
                  if($this->input->post('quantity', TRUE)!=null){
                    $m_cart->quantity = $this->input->post('quantity', TRUE);
                  }
                  else{
                    $m_cart->quantity = 1;
                  }

                  $m_cart->save();
                  $cart_id = $m_cart->last_insert_id();
                }
                else{
                  $cart_id = $temp[0]->cart_id;
                  $qtytemp = $temp[0]->quantity;
                  $m_cart->user_id = $this->session->user_id;
                  $m_cart->product_id = $this->input->post('product_id', TRUE);
                  $m_cart->unit_id = $this->input->post('unit_id', TRUE);
                  $m_cart->is_reserve = 1;
                  if($this->input->post('quantity', TRUE)!=null){
                    $m_cart->quantity = $qtytemp + $this->input->post('quantity', TRUE);
                  }
                  else{
                    $m_cart->quantity = $qtytemp+1;
                  }
                  $m_cart->modify($cart_id);
                }




                $response['stat'] = 'success';
                $response['row_added'] = $m_cart->get_list($cart_id);
                echo json_encode($response);

            break;

            case 'deletereserve':
                $product_id=$this->input->post('product_id',TRUE);
                $this->db->where('product_id', $product_id);
                $this->db->where('is_reserve', 1);
                $this->db->delete('cart');

            break;

            case 'delete':
                $m_cart=$this->Cart_model;
                $cart_id=$this->input->post('cart_id',TRUE);
                $m_cart->delete_via_id($cart_id);

            break;

            case 'update':
                $m_cart=$this->Cart_model;
                $cart_id=$this->input->post('cart_id',TRUE);
                $m_cart->unit_id = $this->input->post('unit_id', TRUE);
                $m_cart->quantity = $this->input->post('unit_id', TRUE);
                $m_cart->modify($cart_id);
                redirect(base_url().'ShoppingCart');
            break;


        }
    }
}
