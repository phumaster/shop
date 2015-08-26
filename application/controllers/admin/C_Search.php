<?php

class C_Search extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/M_admin');
    }

    public function index() {
        if ($_POST) {
            $str = isset($_POST['str']) ? $_POST['str'] : '';
            //$str = str_replace(' ', '|', $str);print_r($str);         
            $data['info'] = $this->M_admin->searchUser($str);
        } else {
            $data['info'] = NULL;
        }
        $this->load->view('admin/V_tbl_list_user', $data);
    }

}
