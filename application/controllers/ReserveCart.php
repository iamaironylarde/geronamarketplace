<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReserveCart extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Carousel_model');
        $this->load->model('Products_model');
        $this->load->model('Category_model');
        $this->load->model('Cart_model');
        // $this->load->model('Users_model');
        // $this->load->model('Wall_post_model');
        // $this->validate_session();

    }

    public function index()
    {
        $user_id=$this->session->user_id;
        $m_carousel=$this->Carousel_model;
        $m_category=$this->Category_model;
        $m_products=$this->Products_model;
        $m_cart=$this->Cart_model;
        $data['_title']="Gerona Marketplace";
        //to view categories in navigation
        $cat['isshoppingcart']=1;

        $cat['category']=$m_category->get_list(
          'category.is_deleted=0 AND category.is_active=1',
          'category.*'
                    );

        $cat['products_cart']=$m_cart->get_list(
          'products.is_deleted=0 AND cart.is_reserve=0 AND cart.user_id='.$user_id,
          'products.product_id,products.product_name,products.category_id,products.price,products.image1,cart.quantity,cart.cart_id,unit.*,discount.*',
                    array(
                          array('products','products.product_id=cart.product_id','left'),
                          array('unit','unit.unit_id=cart.unit_id','left'),
                          array('discount','discount.discount_id=unit.discount_id','left'),
                      )
                    );

        $cat['products_cart1']=$m_cart->get_list(
          'products.is_deleted=0 AND cart.is_reserve=1 AND cart.user_id='.$user_id,
          'products.product_id,products.product_name,products.category_id,products.price,products.image1,cart.quantity,cart.cart_id,unit.*,discount.*',
                    array(
                          array('products','products.product_id=cart.product_id','left'),
                          array('unit','unit.unit_id=cart.unit_id','left'),
                          array('discount','discount.discount_id=unit.discount_id','left'),
                      ),
                    null,
                    'cart.product_id'
                    );

        $data['_footer']=$this->load->view('template/elements/footer','',TRUE);
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation',$cat,TRUE);
        $this->load->view('reserve_cart_view',$data);
        $data['title'] = 'Reserved Products';
    }
}
