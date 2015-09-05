<?php

if (!defined('BASEPATH'))
    exit('Hacking attempt!');

class C_login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_website');
        $this->load->model('M_facebook');
        $this->load->model('admin/M_admin');
    }

    public function index() {
        $data['title'] = 'Đăng nhập';
        $data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('C_login/facebook'),
            'scope' => array("email", "public_profile", "user_about_me", "user_birthday", "user_hometown") // permissions here
        ));
        $this->load->view('V_login', $data);
    }

    public function login() {
        if ($_POST) {
            $website = addslashes($this->input->post('website'));
            try {
                if ($this->validate($website)) {
                    $responsive['error'] = false;
                    $responsive['redirect'] = $website . '.' . $_SERVER['HTTP_HOST'] . '/admin';
                    $responsive['msg'] = 'Thành công! Đang chuyển hướng...';
                }
            } catch (Exception $ex) {
                if ($this->is_ajax()) {
                    $responsive['error'] = true;
                    $responsive['msg'] = $ex->getMessage();
                } else {
                    $this->session->set_flashdata('msg', $ex->getMessage());
                    redirect('C_login');
                }
            }
            echo json_encode($responsive);
        } else {
            redirect('C_login');
        }
    }

    private function validate($website) {
        $this->form_validation->set_rules('website', 'Website', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', 'Vui lòng nhập %s.');
        $query = $this->M_website->getByDomain($website);
        if ($this->form_validation->run() == FALSE) {
            throw new Exception(validation_errors());
            return FALSE;
        } else {
            if (count($query) == 0) {
                throw new Exception("Trang web không tồn tại.");
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function facebook() {
        $user = $this->facebook->getUser();
        if ($user) {
            $userArr = $this->facebook->api('/me');
            $query = $this->M_facebook->getById($userArr['id']);
            if(count($query) == 0){
                // insert data user
                
            }else{
                // user exist
            }
        } else {
            redirect('C_login');
        }
    }

    public function out() {
        $this->facebook->destroySession();
    }

}
