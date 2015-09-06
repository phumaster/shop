<?php

/*
 * @creater Pham Ngoc Phu
 * @email phumaster.dev@gmail.com
 * @controller Admin - Login
 * @project faceweb.vn
 * @company picker
 * @add 10 Hoang Ngoc Phach - Lang Ha - Dong Da - Ha Noi
 */
if (!defined('BASEPATH'))
    exit('Hacking attempt!');

class C_Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/M_admin');
    }

    public function index() {
        $this->load->view('admin/V_login');
    }

    public function signin() {
        if ($_POST) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            try {
                $data = $this->validate($email, $password);
                if ($data) {
                    $this->session->set_userdata('admin', $data);
                    redirect('admin/test');
                }
            } catch (Exception $ex) {
                $this->session->set_flashdata('error_msg', $ex->getMessage());
                redirect('admin/C_login');
            }
        }
    }

    private function validate($email, $password) {
        $rules = [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ]
        ];
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'Vui lòng nhập %s!');
        $this->form_validation->set_message('valid_email', '%s không hợp lệ!');
        if ($this->form_validation->run() == FALSE) {
            throw new Exception(validation_errors());
            return FALSE;
        } else {
            $query = $this->M_admin->attempt($email, $password);
            if ($query->count() == 0) {
                throw new Exception("Tài khoản hoặc mật khẩu không đúng!");
                return FALSE;
            } else if ($query->get()['type'] != 2) {
                throw new Exception("Bạn không phải admin!");
                return FALSE;
            } else {
                return $query->get();
            }
        }
    }

}
