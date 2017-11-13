<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAccounts extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Users_model');
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
        $data['_title'] = 'User Accounts';
        $this->load->view('users_view',$data);

    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                $m_users = $this->Users_model;
                $response['data']=$m_users->get_list('user_accounts.is_deleted=0 AND user_accounts.user_id!=1','user_accounts.*,CONCAT(user_accounts.user_fname," ",user_accounts.user_mname," ",user_accounts.user_lname) as fullname');
                echo json_encode($response);
            break;

            case 'create':
                $m_users = $this->Users_model;


                $m_users->users = $this->input->post('users', TRUE);
                $m_users->users_photo = $this->input->post('users_photo', TRUE);
                $m_users->date_created = date('Y-m-d H:i:s');
                $m_users->created_by = 1;
                // $m_users->created_by = $this->session->user_id;
                $m_users->save();

                $user_id = $m_users->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Brand information successfully created.';
                $response['row_added'] = $m_users->get_list($user_id);
                echo json_encode($response);

            break;

            case 'delete':
                $m_users=$this->Users_model;

                $user_id=$this->input->post('user_id',TRUE);

                $m_users->is_deleted=1;
                $m_users->deleted_by = $this->session->user_id;
                $m_users->date_deleted=date('Y-m-d H:i:s');
                if($m_users->modify($user_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='User information successfully deleted.';

                    echo json_encode($response);
                }

            break;

            case 'update':
                $m_users=$this->Users_model;

                $user_id=$this->input->post('user_id',TRUE);
                $m_users->users = $this->input->post('users', TRUE);
                $m_users->users_photo = $this->input->post('users_photo', TRUE);
                $m_users->date_modified=date('Y-m-d H:i:s');
                 $m_users->created_by = 1;
                $m_users->modify($user_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Brand information successfully updated.';
                $response['row_updated']=$m_users->get_list($user_id);
                echo json_encode($response);

            break;

            case 'changestat':
                $m_users=$this->Users_model;

                $user_id=$this->input->post('user_id',TRUE);
                $is_active=$this->input->post('is_active',TRUE);
                if($is_active==0){
                    $m_users->is_active = 1;
                }
                else{
                     $m_users->is_active = 0;
                }
                 $m_users->modify($user_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='User information successfully updated.';
                $response['row_updated']=$m_users->get_list('user_accounts.is_deleted=0','user_accounts.*,CONCAT(user_accounts.user_fname," ",user_accounts.user_mname," ",user_accounts.user_lname) as fullname');

                echo json_encode($response);

            break;

            case 'changepassword':
                $m_users=$this->Users_model;
                $user_id = $this->session->user_id;
                $user = $m_users->get_list('user_accounts.user_id='.$user_id);
                if( $user[0]->user_pword==sha1($this->input->post('current_password',TRUE)) ){
                    $m_users->user_pword=sha1($this->input->post('new_pass',TRUE));
                    $m_users->modify($user_id);
                    $response['title']='success!';
                    $response['stat']='success';
                    $response['msg']='Admin Account successfully updated.';
                }
                else{
                    $response['title']='error!';
                    $response['stat']='error';
                    $response['msg']='Current Passowrd Doesnt seem right., please try again';
                }
                

                echo json_encode($response);

            break;

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/users/';


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
