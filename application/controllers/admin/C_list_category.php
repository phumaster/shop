<?php

class C_list_category extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/M_category');
    }
    
    public function index() {
        $data['data'] = $this->M_category->getAll();
        $this->load->view('admin/V_list_category');
    }
}