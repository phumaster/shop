<?php

class C_Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $this->load->view('admin/V_dashboard',$data);
    }

}
