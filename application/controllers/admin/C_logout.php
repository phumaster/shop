<?php

/*
 * @creater Pham Ngoc Phu
 * @email phumaster.dev@gmail.com
 * @controller Admin - Logout
 * @project faceweb.vn
 * @company picker
 * @add 10 Hoang Ngoc Phach - Lang Ha - Dong Da - Ha Noi
 */
if (!defined('BASEPATH'))
    exit('Hacking attempt!');

class C_logout extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->session->unset_userdata('admin');
        redirect('admin/C_login');
    }

}
