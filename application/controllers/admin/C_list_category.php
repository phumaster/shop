<?php

class C_list_category extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/M_category');
    }
    
    public function index() {
        $data['data'] = $this->M_category->getAll();
        $data['title'] = 'Thư mục';
        $this->load->view('admin/V_list_category', $data);
    }
    
    public function add() {
        $data['title'] = 'Thêm thư mục mới';
        $this->load->view('admin/V_add_category', $data);
    }
}