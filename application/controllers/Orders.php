<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->load->model('Order_model');
        $this->load->model('Order_items_model');
        $this->validate_sessionadmin();

    }

    public function index()
    {
        $data['_def_css_files']=$this->load->view('template/assets/admin/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/admin/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/admin/top_navigation','',TRUE);
        $data['_side_navigation']=$this->load->view('template/elements/admin/side_bar_navigation','',TRUE);
        $data['_right_navigation']=$this->load->view('template/elements/admin/right_bar_navigation','',TRUE);
        $data['_title'] = 'Products';
        $this->load->view('orders_view',$data);

    }

    function transaction($txn = null) {
        switch ($txn) {

            case 'list':
                $m_order_items = $this->Order_items_model;
                if($this->session->user_group_id==1){
                  $filter = 'products.is_deleted=0';
                }
                else{
                  $filter = 'products.is_deleted=0 AND products.created_by='.$this->session->user_id;
                }
                $user=$this->session->user_id;
                $response['data']=$m_order_items->get_list(
                    $filter,
                    'order_items.*,orders.*,products.product_name,order_status.*,unit.*,discount.*,CONCAT(user_accounts.user_fname," ",user_accounts.user_lname) as ordered_by',
                    array(
                          array('products','products.product_id=order_items.product_id','left'),
                          array('orders','orders.order_id=order_items.order_id','left'),
                          array('order_status','order_status.order_status_id=order_items.order_status_id','left'),
                          array('unit','unit.unit_id=order_items.unit_id','left'),
                          array('discount','discount.discount_id=unit.discount_id','left'),
                          array('user_accounts','user_accounts.user_id=orders.user_id','left'),
                      )
                    );
                echo json_encode($response);
            break;

            case 'changestat':
                $m_order_items=$this->Order_items_model;

                $order_items_id=$this->input->post('order_items_id',TRUE);
                $order_status_id=$this->input->post('order_status_id',TRUE);
                $m_order_items->order_status_id=$order_status_id;
                $m_order_items->modify($order_items_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Order Status successfully updated.';
                $response['row_updated']=$m_order_items->get_list(
                    $order_items_id,
                    'order_items.*,orders.*,products.product_name,order_status.*,unit.*,discount.*',
                    array(
                          array('products','products.product_id=order_items.product_id','left'),
                          array('orders','orders.order_id=order_items.order_id','left'),
                          array('order_status','order_status.order_status_id=order_items.order_status_id','left'),
                          array('unit','unit.unit_id=order_items.unit_id','left'),
                          array('discount','discount.discount_id=unit.discount_id','left'),
                      )
                    );
                echo json_encode($response);

            break;


        }
    }
}
