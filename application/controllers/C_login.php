<?php

class C_login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/M_admin');
    }

    public function index() {
        $data['title'] = 'Đăng nhập';
        $data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('C_login/facebook'),
            'scope' => array("email","public_profile","user_about_me","user_birthday","user_hometown") // permissions here
        ));
        $this->load->view('V_login', $data);
    }

    public function login() {
        if ($_POST) {
            $account = addslashes($this->input->post('account'));
            $password = addslashes($this->input->post('password'));
            try {
                if ($this->validate($account, $password)) {
                    echo 'OK login';
                }
            } catch (Exception $ex) {
                $this->session->set_flashdata('msg', $ex->getMessage());
                redirect('C_login');
            }
        } else {
            redirect('C_login');
        }
    }

    private function validate($account, $password) {
        $this->form_validation->set_rules('account', 'Username', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', 'Vui lòng nhập %s.');
        $query = $this->M_admin->attempt($account, $password);
        if ($this->form_validation->run() == FALSE) {
            throw new Exception(validation_errors());
            return FALSE;
        } else {
            if ($query->count() == 0) {
                throw new Exception("Sai tài khoản hoặc mật khẩu.");
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
    public function facebook() {
        //print_r($this->facebook->getUser());
        $facebook = $this->facebook->api('/me');
        echo '<pre>';
        print_r($facebook);
    }

    public function out(){
        $this->facebook->destroySession();
    }
}
