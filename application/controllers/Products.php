<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Products_model');
        $this->load->model('Category_model');
        $this->load->model('ProductType_model');

        $this->validate_sessionadmin();

    }

    public function index()
    {
        $m_category = $this->Category_model;
        $m_prodtype = $this->ProductType_model;
        $data['_def_css_files']=$this->load->view('template/assets/admin/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/admin/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/admin/top_navigation','',TRUE);
        $data['_side_navigation']=$this->load->view('template/elements/admin/side_bar_navigation','',TRUE);
        $data['_right_navigation']=$this->load->view('template/elements/admin/right_bar_navigation','',TRUE);
        $data['category']=$m_category->get_list(
          'category.is_deleted=0',
          'category.*'
        );
        $data['product_type']=$m_prodtype->get_list();
        $data['_title'] = 'Gerona Marketplace';
        $this->load->view('seller_products_view',$data);

    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                $m_products = $this->Products_model;
                if($this->session->user_group_id==1){
                  $filter = 'products.is_deleted=0';
                }
                else{
                  $filter = 'products.is_deleted=0 AND products.created_by='.$this->session->user_id;
                }
                $user=$this->session->user_id;
                $response['data']=$m_products->get_list(
                    $filter,
                    'products.*,category.category',
                    array(
                          array('category','category.category_id=products.category_id','left'),
                      )
                    );
                echo json_encode($response);
            break;

            case 'create':
                $m_products = $this->Products_model;


                $m_products->product_name = $this->input->post('product_name', TRUE);
                $m_products->product_desc = $this->input->post('product_desc', TRUE);
                $m_products->price = $this->get_numeric_value($this->input->post('price',TRUE));
                $m_products->qty = $this->get_numeric_value($this->input->post('qty',TRUE));
                $m_products->image1 = $this->input->post('image1', TRUE);
                $m_products->image2 = $this->input->post('image2', TRUE);
                $m_products->is_newproduct = $this->input->post('is_newproduct', TRUE);
                $m_products->category_id = $this->input->post('category_id', TRUE);
                $m_products->date_created = date('Y-m-d H:i:s');
                $m_products->created_by = $this->session->user_id;
                $m_products->save();

                $product_id = $m_products->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Product information successfully created.';
                $response['row_added'] = $m_products->get_list(
                    $product_id,
                    'products.*,category.category',
                    array(
                          array('category','category.category_id=products.category_id','left'),
                      )
                    );
                echo json_encode($response);

            break;

            case 'delete':
                $m_products=$this->Products_model;

                $product_id=$this->input->post('product_id',TRUE);

                $m_products->is_deleted=1;
                $m_products->deleted_by = $this->session->user_id;
                $m_products->date_deleted=date('Y-m-d H:i:s');
                if($m_products->modify($product_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Product information successfully deleted.';

                    echo json_encode($response);
                }

            break;

            case 'update':
                $m_products=$this->Products_model;

                $product_id=$this->input->post('product_id',TRUE);
                $m_products->product_name = $this->input->post('product_name', TRUE);
                $m_products->product_desc = $this->input->post('product_desc', TRUE);
                $m_products->price = $this->get_numeric_value($this->input->post('price',TRUE));
                $m_products->qty = $this->get_numeric_value($this->input->post('qty',TRUE));
                $m_products->image1 = $this->input->post('image1', TRUE);
                $m_products->image2 = $this->input->post('image2', TRUE);
                $m_products->is_newproduct = $this->input->post('is_newproduct', TRUE);
                $m_products->category_id = $this->input->post('category_id', TRUE);
                $m_products->date_modified=date('Y-m-d H:i:s');
                // $m_products->modified_by = $this->session->user_id;
                $m_products->modify($product_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Product information successfully updated.';
                $response['row_updated']=$m_products->get_list(
                    $product_id,
                    'products.*,category.category',
                    array(
                          array('category','category.category_id=products.category_id','left'),
                      )
                    );
                echo json_encode($response);

            break;

            case 'changestat':
                $m_products=$this->Products_model;

                $product_id=$this->input->post('product_id',TRUE);
                $is_newarrival=$this->input->post('is_newarrival',TRUE);
                if($is_newarrival==0){
                    $m_products->is_newarrival = 1;
                }
                else{
                     $m_products->is_newarrival = 0;
                }
                 $m_products->modify($product_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Product information successfully updated.';
                $response['row_updated']=$m_products->get_list(
                    $product_id,
                    'products.*,category.category',
                    array(
                          array('category','category.category_id=products.category_id','left'),
                      )
                    );
                echo json_encode($response);

            break;

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/products/';


                foreach($_FILES as $file){

                    $server_file_name=uniqid('');
                    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $file_path=$directory.$server_file_name.'.'.$extension;
                    $orig_file_name=$file['name'];

                    if(!in_array(strtolower($extension), $allowed)){
                        $response['title']='Invalid!';
                        $response['stat']='error';
                        $response['msg']='Image is invalid. Please select a valid photo!';
                        die(json_encode($response));
                    }

                    if(move_uploaded_file($file['tmp_name'],$file_path)){
                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='Image successfully uploaded.';
                        $response['path']=$file_path;
                        echo json_encode($response);
                    }

                }


            break;
        }
    }
}
