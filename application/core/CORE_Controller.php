<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CORE_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    function validate_session(){
        if(!$this->session->user_id){
            redirect(base_url().'Index');
        }
    }

    function validate_sessionadmin(){
        if(!$this->session->user_id){
            redirect(base_url().'Index');
        }
        if($this->session->user_group_id==3){
            redirect(base_url().'Index');
        }
    }

    //to end session of users
    function end_session(){
        session_destroy();
        redirect(base_url().'Index');
    }

    function get_numeric_value($str){
        return (float)str_replace(',','',$str);
    }




}
