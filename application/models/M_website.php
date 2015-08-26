<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_website extends CI_Model {

    private $_table = 'tbl_website';

    function __construct() {
        parent::__construct();
    }

    function delete($id = '') {
        $this->db->where('id = ' . $id);
        return $this->db->delete($this->_table);
    }

    function Sel_Top($limit, $offet) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $offet);
        $query = $this->db->get()->result_array();
        return $query;
    }

    function Sel_All() {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    function selById($Id) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id', $Id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function Upd($arr, $Id) {
        $this->db->where('id', $Id);
        return $this->db->update($this->_table, $arr);
    }

    public function insert($data = []) {
        return $this->db->insert($this->_table, $data);
    }

    function count($subdomain = '') {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('subdomain', $subdomain);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    public function delByUserid($id = '') {
        $this->db->where('IDuser', $id);
        return $this->db->delete($this->_table);
    }

    public function selectByUserid($id = '') {
        $this->db->select('*')->from($this->_table);
        $this->db->where('IDuser', $id);
        return $this->db->get()->row_array();
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result_array();
    }
    public function countAll() {
        return $this->db->count_all($this->_table);
    }

    public function getLimit($offset, $row) {
        $this->db->select('email, IDcategoryLevel1, tbl_website.id, subdomain, IDuser, tbl_website.type, tbl_website.disable, tbl_website.status, avaiableFrom, avaiableTo');
        $this->db->from($this->_table);
        $this->db->join('tbl_user','tbl_user.id = '.$this->_table.'.IDUser', 'left');
        $this->db->limit($offset, $row);
        $this->db->order_by($this->_table.'.id', 'ASC');
        return $this->db->get()->result_array();
    }
}

?>