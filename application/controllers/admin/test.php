<?php

class Test extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        echo '<pre>';
        print_r($this->session->all_userdata());
    }
}