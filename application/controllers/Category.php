<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Category_model');
        $this->load->model('ProductType_model');

    }

    public function index()
    {
        $m_prodtype = $this->ProductType_model;
        $data['_def_css_files']=$this->load->view('template/assets/admin/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/admin/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/admin/top_navigation','',TRUE);
        $data['_side_navigation']=$this->load->view('template/elements/admin/side_bar_navigation','',TRUE);
        $data['_right_navigation']=$this->load->view('template/elements/admin/right_bar_navigation','',TRUE);
        $data['_title'] = 'Category';
        $data['product_type']=$m_prodtype->get_list();
        $this->load->view('seller_category_view',$data);

    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                $m_category = $this->Category_model;
                $response['data']=$m_category->get_list(array('category.is_deleted'=>FALSE));
                echo json_encode($response);
            break;

            case 'create':
                $m_category = $this->Category_model;


                $m_category->category = $this->input->post('category', TRUE);
                $m_category->category_photo = $this->input->post('category_photo', TRUE);
                $m_category->product_type_id = $this->input->post('product_type_id', TRUE);
                $m_category->date_created = date('Y-m-d H:i:s');
                $m_category->created_by = 1;
                // $m_category->created_by = $this->session->user_id;
                $m_category->save();

                $category_id = $m_category->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Brand information successfully created.';
                $response['row_added'] = $m_category->get_list($category_id);
                echo json_encode($response);

            break;

            case 'delete':
                $m_category=$this->Category_model;

                $category_id=$this->input->post('category_id',TRUE);

                $m_category->is_deleted=1;
                $m_category->deleted_by = $this->session->user_id;
                $m_category->date_deleted=date('Y-m-d H:i:s');
                if($m_category->modify($category_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Brand information successfully deleted.';

                    echo json_encode($response);
                }

            break;

            case 'update':
                $m_category=$this->Category_model;

                $category_id=$this->input->post('category_id',TRUE);
                $m_category->category = $this->input->post('category', TRUE);
                $m_category->category_photo = $this->input->post('category_photo', TRUE);
                $m_category->product_type_id = $this->input->post('product_type_id', TRUE);
                $m_category->date_modified=date('Y-m-d H:i:s');
                 $m_category->created_by = 1;
                $m_category->modify($category_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Brand information successfully updated.';
                $response['row_updated']=$m_category->get_list($category_id);
                echo json_encode($response);

            break;

            case 'changestat':
                $m_category=$this->Category_model;

                $category_id=$this->input->post('category_id',TRUE);
                $is_active=$this->input->post('is_active',TRUE);
                if($is_active==0){
                    $m_category->is_active = 1;
                }
                else{
                     $m_category->is_active = 0;
                }
                 $m_category->modify($category_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Carousel information successfully updated.';
                $response['row_updated']=$m_category->get_list($category_id);
                echo json_encode($response);

            break;

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/category/';


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
