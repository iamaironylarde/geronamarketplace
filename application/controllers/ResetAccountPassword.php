<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetAccountPassword extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        // $this->validate_session();
        $this->load->model('Users_model');
        $this->load->model('Category_model');
        $this->load->model('Barangay_model');
        $this->load->helper('url');
    }


    public function index()
    {
        $m_category=$this->Category_model;
        $m_barangay=$this->Barangay_model;
        $data['_title']="Gerona Marketplace";

        $data['_footer']=$this->load->view('template/elements/footer','',TRUE);
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation','',TRUE);
        $this->load->view('reset_account_password_view',$data);

    }


    function transaction($txn=null){

        switch($txn){


                case 'checktoken' :
                  $m_users=$this->Users_model;
                  $user_id=$this->input->post('user_id',TRUE);
                  $token=$this->input->post('token',TRUE);
                  $result=$m_users->validatetoken($user_id,$token);
                  if($result->num_rows()>0){//valid username and pword
                    
                    $m_users->user_pword=sha1($this->input->post('user_pword',TRUE));
                    $m_users->resettoken = '';
                    $m_users->modify($user_id);
                    $response['stat']='success';
                    $response['msg']='Password succcessfully updated.';
                    echo json_encode($response);
                  }
                  else{
                    $response['stat']='error';
                    $response['msg']='Reset Token Expired.';
                    echo json_encode($response);
                  }
                  // $m_users->is_active = 1;
                  // $m_users->modify($user_id);
                  // redirect(base_url().'Index');
                break;

                default:


        }




    }




}
