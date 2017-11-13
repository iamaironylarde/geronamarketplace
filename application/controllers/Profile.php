<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Carousel_model');
        $this->load->model('Products_model');
        $this->load->model('Category_model');
        $this->load->model('Cart_model');
        $this->load->model('Order_model');
        $this->load->model('Barangay_model');
        
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
        $m_barangay=$this->Barangay_model;
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
        $data['barangay']=$m_barangay->get_list();

        $data['_footer']=$this->load->view('template/elements/footer','',TRUE);
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation',$cat,TRUE);
        $this->load->view('profile_view',$data);
        $data['title'] = 'Profile';
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'create':
                $m_wallpost=$this->Wall_post_model;
                $m_wallpost->post_content=$this->input->post('post_content',TRUE);
                $m_wallpost->user_id = $this->session->user_id;
                $m_wallpost->date_created = date("Y-m-d H:i:s");
                $m_wallpost->save();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Post Successfull.';
                echo json_encode($response);

            break;
        }
    }
}
