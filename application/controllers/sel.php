<?php

class Sel extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //$file = file('./SubSystemDefault/Database/opencart.sql');
        //print_r($file);
        /*
          $tem = '';
          foreach ($file as $line){
          if(substr($line,0,2) == '--' || $line == ''){
          continue;
          }
          $tem .=$line;
          }
         * */
        //echo $tem;
        $dir = $this->controller('dir');
        $dir->this();
    }

}
