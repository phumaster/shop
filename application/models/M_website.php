<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_website extends CI_Model {

    private $table = 'tbl_website';

    function __construct() {
        parent::__construct();
    }

    function delete($id = '') {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function insert($data = []) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data = []) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function count($subdomain = '') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('subdomain', $subdomain);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    public function getByUserId($id = '') {
        $this->db->select('*')->from($this->table);
        $this->db->where('IDuser', $id);
        return $this->db->get()->row_array();
    }
    
    public function delByUserId($id = '') {
        $this->db->where('IDuser', $id);
        return $this->db->delete($this->table);
    }

    public function getId($id = '') {
        $this->db->select('*')->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }
    
    public function getByDomain($domain = '') {
        $this->db->select('*')->from($this->table);
        $this->db->where('subdomain', $domain);
        return $this->db->get()->row_array();
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function countAll() {
        return $this->db->count_all($this->table);
    }

    public function getLimit($offset, $row) {
        $this->db->select('email, IDcategoryLevel1, tbl_website.id, subdomain, IDuser, tbl_website.type, tbl_website.disable, tbl_website.status, avaiableFrom, avaiableTo');
        $this->db->from($this->table);
        $this->db->join('tbl_user', 'tbl_user.id = ' . $this->table . '.IDUser', 'left');
        $this->db->limit($offset, $row);
        $this->db->order_by($this->table . '.id', 'ASC');
        return $this->db->get()->result_array();
    }
    
    public function delDatabase($name = '') {
        mysql_query("DROP DATABASE `$name`");
        return;
    }

}

?>