<?php

class M_category extends CI_Model {

    private $table = 'tbl_categorylevel1';

    public function __construct() {
        parent::__construct();
    }

    public function insert($data = []) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function update($id, $data = []) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function countAll() {
        return $this->db->count_all_results($this->table);
    }

}
