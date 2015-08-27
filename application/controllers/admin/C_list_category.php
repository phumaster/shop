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
        if ($_POST) {
            $name = $this->input->post('name');
            try {
                if ($this->validate_add()) {
                    if($this->M_category->insert(['name' => $name])){
                        redirect('admin/C_list_category');
                    }else{
                        throw new Exception("Insert error!");
                    }
                }
            } catch (Exception $error) {
                $data['error_msg'] = $error->getMessage();
            }
        }
        $this->load->view('admin/V_add_category', $data);
    }

    private function validate_add() {
        $this->form_validation->set_rules('name', 'Tiêu đề', 'trim|required|max_length[255]|xss_clean');
        if ($this->form_validation->run()) {
            return TRUE;
        } else {
            throw new Exception(validation_errors());
            return FALSE;
        }
    }

}
