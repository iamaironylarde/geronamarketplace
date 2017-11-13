<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyOrders extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Carousel_model');
        $this->load->model('Products_model');
        $this->load->model('Category_model');
        $this->load->model('Cart_model');
        $this->load->model('Order_model');
        $this->load->model('Order_items_model');
        
        $this->validate_session();

    }

    public function index()
    {
        $user_id=$this->session->user_id;
        $m_carousel=$this->Carousel_model;
        $m_category=$this->Category_model;
        $m_products=$this->Products_model;
        $m_cart=$this->Cart_model;
        $m_orders=$this->Order_model;
        $data['_title']="Gerona Marketplace";
        //to view categories in navigation
        $cat['products_cart']=$m_cart->get_list(
          'products.is_deleted=0 AND cart.user_id='.$user_id,
          'products.product_id,products.product_name,products.price,products.image1,cart.quantity,cart.cart_id',
                    array(
                          array('products','products.product_id=cart.product_id','left'),
                      ),
          null,
          'product_id'
                    );

        $cat['category']=$m_category->get_list(
          'category.is_deleted=0 AND category.is_active=1',
          'category.*'
                    );

        $cat['myoders']=$m_orders->get_list(
          'user_accounts.user_id='.$user_id,
          'orders.*,products.*,order_items.*,order_status.order_status_name,unit.*,discount.*,brgy.*',
                    array(
                          array('order_items','order_items.order_id=orders.order_id','left'),
                          array('products','products.product_id=order_items.product_id','left'),
                          array('order_status','order_status.order_status_id=order_items.order_status_id','left'),
                          array('unit','unit.unit_id=order_items.unit_id','left'),
                          array('discount','discount.discount_id=unit.discount_id','left'),
                          array('user_accounts','user_accounts.user_id=orders.user_id','left'),
                          array('brgy','brgy.brgy_id=user_accounts.brgy_id','left'),
                      )
                    );

        $data['_footer']=$this->load->view('template/elements/footer','',TRUE);
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation',$cat,TRUE);
        $this->load->view('my_orders_view',$data);
        $data['title'] = 'Dashboard';
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'delete':
                $m_order_items=$this->Order_items_model;
                $m_order=$this->Order_model;
                $m_products=$this->Products_model;
                $order_id=$this->input->post('order_id',TRUE);
                $order_items_id=$this->input->post('order_items_id',TRUE);
                $order_qty=$this->input->post('order_qty',TRUE);
                $product_id=$this->input->post('product_id',TRUE);

                $m_order_items->order_status_id=3;
                $m_order_items->modify($order_items_id);
                $m_products->set('qty','qty+'.$order_qty);
                $m_products->modify($product_id);
                // $m_order_items->delete_via_id($order_items_id);
                // $itemslist = $m_order_items->get_list('order_id='.$order_id,'order_items.order_items_id');
                
                // if(count($itemslist)!=0){
                // }
                // else{
                //   $m_order->modify($order_id);
                // }
                redirect(base_url().'MyOrders');
            break;
        }
    }
}
