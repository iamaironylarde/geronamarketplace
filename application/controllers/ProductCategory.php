<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductCategory extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Carousel_model');
        $this->load->model('Products_model');
        $this->load->model('Category_model');
        $this->load->model('Cart_model');
        $this->load->model('ProductType_model');
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
        $m_prodtype = $this->ProductType_model;
        $data['product_type']=$m_prodtype->get_list();

        if (is_numeric($this->input->get('product_type_id',TRUE))) {
          $data['singlecat']="";
          $product_type_id = $this->input->get('product_type_id',TRUE);
          $data['product_type_id']=$product_type_id;
          if( $this->input->get('category',TRUE)!="" ){
            $category_id = $this->input->get('category',TRUE);
            $data['product_info']=$m_products->get_list(
              'products.is_deleted=0 AND category.product_type_id='.$product_type_id.' AND category.category_id='.$category_id,
              'products.*,category.category,product_type.product_type',
                array(
                      array('category','category.category_id=products.category_id','left'),
                      array('product_type','product_type.product_type_id=category.product_type_id','left'),
                  )
            );
          }
          else{
            $data['product_info']=$m_products->get_list(
              'products.is_deleted=0 AND category.product_type_id='.$product_type_id,
              'products.*,category.category,product_type.product_type',
                array(
                      array('category','category.category_id=products.category_id','left'),
                      array('product_type','product_type.product_type_id=category.product_type_id','left'),
                  )
            );
          }

        }


        else if (isset($_GET['searchitem'])) {
          $data['singlecat']="search";
          $searchitem = $this->input->get('searchitem',TRUE);
          $data['product_info']=$m_products->get_list(
            'products.is_deleted=0 AND products.product_name LIKE "%'.$searchitem.'%"',
            'products.*,category.category',
              array(
                    array('category','category.category_id=products.category_id','left'),
                    array('product_type','product_type.product_type_id=category.product_type_id','left'),
                )
          );
        }
        else{
          redirect(base_url().'Index');
        }




        $data['_title']="Gerona Marketplace";
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


        $data['category']=$m_category->get_list(
          'category.is_deleted=0 AND category.is_active=1',
          'category.*'
                    );
        $data['_footer']=$this->load->view('template/elements/footer','',TRUE);
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation',$cat,TRUE);

        $this->load->view('product_category_view',$data);
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
