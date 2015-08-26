<?php

class Upload extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('upload');
    }

    public function process() {
        //echo '<pre>';
        //print_r($_POST);
        $conf['upload_path'] = './upload/';
        $conf['max_size'] = 2048;
        $conf['allowed_types'] = 'png|jpg|gif';
        $this->upload->initialize($conf);
        sleep(2);
        if ($this->upload->do_upload('img')) {
            echo 'Upload success!';
            //print_r($this->upload->data());
        } else {
            echo $this->upload->display_errors();
        }
        //echo '</pre>';
        //print_r($_FILES);
        //echo $_SERVER['HTTP_X_REQUESTED_WITH'];
    }

}
