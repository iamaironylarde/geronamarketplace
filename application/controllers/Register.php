<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        // $this->validate_session();
        require 'application/third_party/phpmail/PHPMailerAutoload.php';
        $this->load->model('Users_model');
        $this->load->model('Category_model');
        $this->load->model('Barangay_model');
    }


    public function index()
    {
        $m_category=$this->Category_model;
        $m_barangay=$this->Barangay_model;
        $data['_title']="Gerona Marketplace";
        $cat['category']=$m_category->get_list(
          'category.is_deleted=0 AND category.is_active=1',
          'category.*'
                    );
        $this->create_required_default_data();

        $data['_footer']=$this->load->view('template/elements/footer','',TRUE);
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation',$cat,TRUE);
        $data['barangay']=$m_barangay->get_list();
        $this->load->view('register_view',$data);

    }

    function create_required_default_data(){

        $m_users=$this->Users_model;
        $m_users->create_default_user();

    }


    function transaction($txn=null){

        switch($txn){

                case 'register':
                    $m_users=$this->Users_model;
                    $this->load->library('form_validation');
                    $this->load->helper('security');
                    $user_name=$this->input->post('user_name', TRUE);
                    $usercount = $this->Users_model->checkifuserexist($user_name);
                    if ($usercount==0){
                        $this->form_validation->set_rules('user_name', 'Email Address', 'strip_tags|trim|xss_clean|required|valid_email');
                        $this->form_validation->set_rules('user_fname', 'First Name', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('user_lname', 'Last Name', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('user_address', 'Address', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('brgy_id', 'Barangay', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('user_mobile', 'Contact #', 'strip_tags|trim|xss_clean|required');
                        $this->form_validation->set_rules('user_pword', 'Password', 'strip_tags|trim|xss_clean|required|min_length[6]');
                        if ($this->form_validation->run() == TRUE){
                          $m_users->user_name = $this->input->post('user_name', TRUE);
                          $m_users->user_fname = $this->input->post('user_fname', TRUE);
                          $m_users->user_lname = $this->input->post('user_lname', TRUE);
                          $m_users->user_address = $this->input->post('user_address', TRUE);
                          $m_users->brgy_id = $this->input->post('brgy_id', TRUE);
                          $m_users->user_mobile = $this->input->post('user_mobile', TRUE);
                          $m_users->user_pword=sha1($this->input->post('user_pword',TRUE));
                          $m_users->user_group_id = 2;
                          $m_users->date_created = date('Y-m-d H:i:s');
                          $m_users->save();

                          $user_id = $m_users->last_insert_id();
                          $base = base_url();
                          $user_name = $this->input->post('user_name', TRUE);
                          $user_fname = $this->input->post('user_fname', TRUE);
                          $user_lname = $this->input->post('user_lname', TRUE);
                          $mail = new PHPMailer;
                          //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                          $mail->isSMTP();                                      // Set mailer to use SMTP
                          $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                          $mail->SMTPAuth = true;                               // Enable SMTP authentication
                          $mail->Username = 'tsuccsmeat09@gmail.com';                 // SMTP username
                          $mail->Password = 'tsuccsmeat';                           // SMTP password
                          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                          $mail->Port = 587;                                    // TCP port to connect to

                          $mail->setFrom($user_name, 'Gerona Marketplace');
                          $mail->addAddress($user_name, $user_fname.' '.$user_lname);     // Add a recipient
                          // $mail->addAddress('ellen@example.com');               // Name is optional
                          $mail->addReplyTo('tsuccsmeat09@gmail.com', 'Gerona Marketplace');
                          $mail->addCC('tsuccsmeat09@gmail.com');
                          $mail->addBCC('tsuccsmeat09@gmail.com');

                          $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                          $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                          $mail->isHTML(true);                                  // Set email format to HTML

                          $mail->Subject = 'Hello '.$user_fname.' '.$user_lname;

                          $regcontent = $this->load->view('template/elements/regcontent_view',null,TRUE);
                          $mail->Body = $regcontent;

                          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                          if(!$mail->send()) {
                          $response['email_stat']="failed";
                          } else {
                          $response['email_stat']="success";
                          }

                          $response['stat']='success';
                          $response['msg'] = 'Account successfully created, please wait for the admin to approve your account.';

                        }
                        else{
                          $response['stat'] = 'error';
                          $response['msg'] = validation_errors();
                        }
                    }
                    else
                    {
                        $response['stat'] = 'error';
                        $response['msg'] = 'Email address is already exist.';
                    }

                    echo json_encode($response);

                break;

                case 'verifyemail' :
                  $m_users=$this->Users_model;
                  $user_id=$this->input->get('code',TRUE);
                  $m_users->is_active = 1;
                  $m_users->modify($user_id);
                  redirect(base_url().'Index');
                break;

                default:


        }




    }




}
