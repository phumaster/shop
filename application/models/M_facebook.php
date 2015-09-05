<?php

if (!defined('BASEPATH'))
    exit('Hacking attempt!');

class M_facebook extends CI_Model {

    private $table = 'tbl_facebook';

    public function __construct() {
        parent::__construct();
    }

    public function delete($id = NULL) {
        $id = (int) $id;
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function insert($data = []) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id = NULL, $data = []) {
        $id = (int) $id;
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function getAll() {
        $this->db->select('*')->from($this->table);
        return $this->db->get()->result_array();
    }

    public function getById($id = NULL) {
        $id = (int) $id;
        $this->db->select('*')->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function getByName($name = '') {
        $name = (string) $name;
        $this->db->select('*')->from($this->table);
        $this->db->where('name', $name);
        return $this->db->get()->row_array();
    }

    public function countAll() {
        return $this->db->count_all_results($this->table);
    }

}
