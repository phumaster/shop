<?php

class M_opencart extends CI_Model {
    private $table = 'oc_user';
    public function __construct() {
        parent::__construct();
    }
    
    public function addAdmin($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}