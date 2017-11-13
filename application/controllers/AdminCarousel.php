<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCarousel extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Carousel_model');
        // $this->load->model('Users_model');
        // $this->load->model('Wall_post_model');
        // $this->validate_session();

    }

    public function index()
    {

        $data['_def_css_files']=$this->load->view('template/assets/admin/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/admin/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/admin/top_navigation','',TRUE);
        $data['_side_navigation']=$this->load->view('template/elements/admin/side_bar_navigation','',TRUE);
        $data['_right_navigation']=$this->load->view('template/elements/admin/right_bar_navigation','',TRUE);
        $data['_title'] = 'Carousel';
        $this->load->view('seller_carousel_view',$data);
        
    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                $m_carousel = $this->Carousel_model;
                $response['data']=$m_carousel->get_list(array('carousel.is_deleted'=>FALSE));
                echo json_encode($response);
            break;

            case 'create':
                $m_carousel = $this->Carousel_model;

                $m_carousel->carousel = $this->input->post('carousel', TRUE);
                $m_carousel->carousel_photo = $this->input->post('carousel_photo', TRUE);
                $m_carousel->date_created = date('Y-m-d H:i:s');
                // $m_carousel->created_by = $this->session->user_id;
                $m_carousel->created_by = 1;
                $m_carousel->save();

                $carousel_id = $m_carousel->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Carousel information successfully created.';
                $response['row_added'] = $m_carousel->get_list($carousel_id);
                echo json_encode($response);

            break;

            case 'delete':
                $m_carousel=$this->Carousel_model;

                $carousel_id=$this->input->post('carousel_id',TRUE);

                $m_carousel->is_deleted=1;
                $m_carousel->deleted_by = $this->session->user_id;
                $m_carousel->date_deleted=date('Y-m-d H:i:s');
                if($m_carousel->modify($carousel_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Carousel information successfully deleted.';

                    echo json_encode($response);
                }

            break;

            case 'update':
                $m_carousel=$this->Carousel_model;

                $carousel_id=$this->input->post('carousel_id',TRUE);
                $m_carousel->carousel = $this->input->post('carousel', TRUE);
                $m_carousel->carousel_photo = $this->input->post('carousel_photo', TRUE);
                $m_carousel->date_modified=date('Y-m-d H:i:s');
                $m_carousel->modified_by = $this->session->user_id;
                $m_carousel->modify($carousel_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Carousel information successfully updated.';
                $response['row_updated']=$m_carousel->get_list($carousel_id);
                echo json_encode($response);

            break;

            case 'changestat':
                $m_carousel=$this->Carousel_model;

                $carousel_id=$this->input->post('carousel_id',TRUE);
                $is_active=$this->input->post('is_active',TRUE);
                if($is_active==0){
                    $m_carousel->is_active = 1;
                }
                else{
                     $m_carousel->is_active = 0;
                }
                 $m_carousel->modify($carousel_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Carousel information successfully updated.';
                $response['row_updated']=$m_carousel->get_list($carousel_id);
                echo json_encode($response);

            break;

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/carousel/';


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
