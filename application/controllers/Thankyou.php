<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thankyou extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        require 'application/third_party/phpmail/PHPMailerAutoload.php';
        $this->load->model('Carousel_model');
        $this->load->model('Products_model');
        $this->load->model('Category_model');
        $this->load->model('Cart_model');
        $this->load->model('Order_model');
        // $this->load->model('Wall_post_model');
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
        $data['_title']="Gerona Marketplace";
        //to view categories in navigation

        if(is_numeric($this->input->get('order_id',TRUE)) ){
          $order_id=$this->input->get('order_id',TRUE);
          $data['order_info']=$m_orders->get_list(
            'orders.order_id='.$order_id,
            'orders.*,products.product_name,products.price,order_items.*,CONCAT(user_accounts.user_fname," ",user_accounts.user_lname) as full_name,unit.*,discount.*',
            array(
                  array('order_items','order_items.order_id=orders.order_id','left'),
                  array('products','products.product_id=order_items.product_id','left'),
                  array('user_accounts','user_accounts.user_id=orders.user_id','left'),
                  array('unit','unit.unit_id=order_items.unit_id','left'),
                  array('discount','discount.discount_id=unit.discount_id','left'),
              )
          );
        }
        else{
          redirect(base_url().'Index');
        }

        $cat['category']=$m_category->get_list(
          'category.is_deleted=0 AND category.is_active=1',
          'category.*'
                    );

        $cat['products_cart']=$m_cart->get_list(
          'products.is_deleted=0 AND cart.user_id='.$user_id,
          'products.product_id,products.product_name,products.price,products.image1,cart.quantity,cart.cart_id',
                    array(
                          array('products','products.product_id=cart.product_id','left'),
                      )
                    );



        $data['_footer']=$this->load->view('template/elements/footer','',TRUE);
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation',$cat,TRUE);

        $data['title'] = 'Thank You For Your Order';

        $mail = new PHPMailer;
        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'tsuccsmeat09@gmail.com';                 // SMTP username
        $mail->Password = 'tsuccsmeat';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom($this->session->user_name, 'Gerona Marketplace');
        $mail->addAddress($this->session->user_name, $this->session->user_fname.' '.$this->session->user_lname);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('tsuccsmeat09@gmail.com', 'Gerona Marketplace');
        $mail->addCC('tsuccsmeat09@gmail.com');
        $mail->addBCC('tsuccsmeat09@gmail.com');

        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Order Receipt of '.$this->session->user_fname.' '.$this->session->user_lname;
        $emailcontent = $this->load->view('template/elements/email_view',$data,TRUE);
        $mail->Body    = $emailcontent;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
        $response['email_stat']=$mail->ErrorInfo;
        } else {
        $response['email_stat']="success";
        }

        $this->load->view('thankyou_view',$data);

        // echo json_encode($response);
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
