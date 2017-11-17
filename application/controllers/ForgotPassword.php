<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        // $this->validate_session();
        require 'application/third_party/phpmail/PHPMailerAutoload.php';
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
        $this->load->view('forgot_password_view',$data);

    }


    function transaction($txn=null){

        switch($txn){

                case 'resetpassword':
                    $uname = $this->input->post('uname', TRUE);
                    $encrypt =  md5($uname);
                    $static_str='_GRM';
                    $currenttimeseconds = date("mdYHis");
                    $token_id=$static_str.$encrypt.$currenttimeseconds;
                    
                    

                    $users=$this->Users_model;
                    $result=$users->validateaccount($uname);

                    if($result->num_rows()>0){//valid username and pword
                        $user_id = $result->row()->user_id;
                        $user_fname = $result->row()->user_fname;
                        $user_lname = $result->row()->user_lname;
                        $userdata['user_fullname'] = $result->row()->user_fullname;
                        $userdata['user_name'] = $uname;
                        $userdata['user_id'] =  $user_id;
                        $userdata['token_id'] = $token_id;
                        $userdata['base'] = base_url();
                        $users->resettoken = $token_id;
                        $users->modify($user_id);
                        $response['stat']='success';
                        $response['msg']="We've sent an email to <b>".$uname."</b>. Click the link in the email to reset your password.";

                        $mail = new PHPMailer;
                        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'tsuccsmeat09@gmail.com';                 // SMTP username
                        $mail->Password = 'tsuccsmeat';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        $mail->setFrom($uname, 'Gerona Marketplace');
                        $mail->addAddress($uname, $user_fname.' '.$user_lname);     // Add a recipient
                        // $mail->addAddress('ellen@example.com');               // Name is optional
                        $mail->addReplyTo('tsuccsmeat09@gmail.com', 'Gerona Marketplace');
                        $mail->addCC('tsuccsmeat09@gmail.com');
                        $mail->addBCC('tsuccsmeat09@gmail.com');

                        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = 'Hello '.$user_fname.' '.$user_lname;

                        $forgotpass_view = $this->load->view('template/elements/forgotpass_view',$userdata,TRUE);
                        $mail->Body = $forgotpass_view;

                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        if(!$mail->send()) {
                        $response['email_stat']="failed";
                        } else {
                        $response['email_stat']="success";
                        }

                        echo json_encode($response);

                    }
                    else{ //not valid

                        $response['stat']='error';
                        $response['msg']='Email address not found.';
                        echo json_encode($response);

                    }


                break;

                case 'checktoken' :
                  $m_users=$this->Users_model;
                  $user_id=$this->input->get('user_id',TRUE);
                  $token=$this->input->get('token',TRUE);
                  $result=$m_users->validatetoken($user_id,$token);
                  if($result->num_rows()>0){//valid username and pword
                    redirect(base_url()."ResetAccountPassword?user_id=".$user_id.'&token='.$token);
                  }
                  else{
                    echo "test";
                  }
                  // $m_users->is_active = 1;
                  // $m_users->modify($user_id);
                  // redirect(base_url().'Index');
                break;

                default:


        }




    }




}
