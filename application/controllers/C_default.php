<?php

class C_default extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/M_category');
    }
    
    public function index() {
        $data['category'] = $this->M_category->getAll();
        $this->load->view('V_default', $data);
    }
}