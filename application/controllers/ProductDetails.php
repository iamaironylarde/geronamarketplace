<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductDetails extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Carousel_model');
        $this->load->model('Products_model');
        $this->load->model('Category_model');
        $this->load->model('Cart_model');
        $this->load->model('Unit_model');

    }

    public function index()
    {
        $user_id=$this->session->user_id;
        $m_carousel=$this->Carousel_model;
        $m_category=$this->Category_model;
        $m_products=$this->Products_model;
        $m_cart=$this->Cart_model;
        $m_unit=$this->Unit_model;
        $data['_title']="Gerona Marketplace";

        if (is_numeric($this->input->get('getprodinfo',TRUE))) {
          $product_id = $this->input->get('getprodinfo',TRUE);
        }
        else{
          redirect(base_url().'Index');
        }
          $product_id=$this->input->get('getprodinfo',TRUE);
          $data['product_info']=$m_products->get_list(
            'products.is_deleted=0 AND products.product_id='.$product_id,
            'products.*,category.category,CONCAT(user_accounts.user_fname," ",user_accounts.user_lname) as sellername,
            user_accounts.user_address,user_accounts.user_mobile,product_type.product_type',
              array(
                    array('category','category.category_id=products.category_id','left'),
                    array('product_type','product_type.product_type_id=category.product_type_id','left'),
                    array('user_accounts','user_accounts.user_id=products.created_by','left')
                )
          );


        //to view categories in navigation
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

        $data['units'] = $m_unit->get_list();
        $data['carousel']=$m_carousel->get_list(
          'carousel.is_deleted=0 AND carousel.is_active=1',
          'carousel.*'
        );

        $data['products_new']=$m_products->get_list(
          'products.is_deleted=0 AND products.is_newarrival=1',
          'products.*,category.category',
                    array(
                          array('category','category.category_id=products.category_id','left')
                      )
                    );
        if (is_numeric($this->input->get('category_id',TRUE))) {
          $category_id = $this->input->get('category_id',TRUE);
          $cat['similar_items']=$m_products->get_similaritems($category_id);
        }
        else{
          $cat['similar_items']="";
        }


        $data['category']=$m_category->get_list(
          'category.is_deleted=0 AND category.is_active=1',
          'category.*'
                    );


        $data['_footer']=$this->load->view('template/elements/footer','',TRUE);
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation',$cat,TRUE);
        $data['_shopping_cart']=$this->load->view('template/elements/modal_shopping_cart',$cat,TRUE);
        $this->load->view('product_details',$data);
        $data['title'] = 'Dashboard';
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
