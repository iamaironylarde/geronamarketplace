<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminReservations extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->validate_sessionadmin();

    }

    public function index()
    {
        $data['_def_css_files']=$this->load->view('template/assets/admin/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/admin/js_files','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/admin/top_navigation','',TRUE);
        $data['_side_navigation']=$this->load->view('template/elements/admin/side_bar_navigation','',TRUE);
        $data['_right_navigation']=$this->load->view('template/elements/admin/right_bar_navigation','',TRUE);
        $data['_title'] = 'Reservations';
        $this->load->view('reservations_view',$data);

    }

}
