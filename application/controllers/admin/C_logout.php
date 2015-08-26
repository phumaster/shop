<?php

class C_logout extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->session->unset_userdata('admin');
        redirect('admin/C_login');
    }

}
