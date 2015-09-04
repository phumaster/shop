<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->uri->segment(1) == 'admin' && $this->router->fetch_class() != 'C_login') {
            if (!$this->session->userdata('admin')) {
                redirect('admin/C_login');
            }
        }
        if ($this->uri->segment(1) == 'admin' && $this->router->fetch_class() == 'C_login') {
            if ($this->session->userdata('admin')) {
                redirect('admin/C_dashboard');
            }
        }
        if ($this->uri->segment(1) == 'admin') {
            if ($this->session->userdata('user') && !empty($this->session->userdata('user'))) {
                redirect('/');
            }
        }
    }

    public function controller($controller = '') {
        $CI = & get_instance(); // foundation alias in codeigniter
        $filename = $controller;
        // remove '/' in string
        $filename = trim($filename, '/');
        // Constant APPPATH application/
        $path = APPPATH . 'controllers/' . $filename . '.php';
        // string to array
        $filename = explode('/', $filename);
        // get class name
        $class = $filename[count($filename) - 1];
        // upper first character in classname
        $class = ucfirst($class);
        if (!file_exists($path)) {
            die("Class not found!");
        } else {
            require_once $path; // require
            return $CI->$class = new $class();
        }
    }

    public function is_ajax() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } else {
            return false;
        }
    }

}
