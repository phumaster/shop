<?php

if (!defined('BASEPATH'))
    exit('Hacking attempt!');

class M_admin extends CI_Model {

    private $table = 'tbl_user';
    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllUser() {
        $this->db->select('*')->from($this->table);
        return $this->db->get()->result_array();
    }

    public function countAll() {
        return $this->db->count_all_results($this->table);
    }

    public function getLimit($limit, $location, $where) {
        $this->db->select('tbl_user.id, username, email, mobile, address, city, birthday, tbl_user.status, tbl_user.disable, tbl_user.type, avatar, created_at, subdomain')->from($this->table);
        $this->db->join('tbl_website', 'tbl_user.id = tbl_website.IDuser', 'left');
        $this->db->limit($limit, $location);
        if ($where == 'desc') {
            $this->db->order_by('id', 'desc');
        } else if ($where == 'name') {
            $this->db->order_by('username', 'asc');
        } else if ($where == 'email') {
            $this->db->order_by('email', 'asc');
        } else {
            $this->db->order_by('id', 'asc');
        }
        return $this->db->get()->result_array();
    }

    public function getUser($id) {
        $this->db->select('*')->from($this->table);
        $this->db->where('id', $id);
        $this->data = $this->db->get();
        return $this;
    }

    public function attempt($email, $password) {
        $this->data = $this->db->query("SELECT * FROM `$this->table` WHERE `email`= '$email' AND `password` = SHA1(CONCAT(salt,SHA1(CONCAT(salt,SHA1('$password')))))");
        return $this;
    }

    public function get() {
        return $this->data->row_array();
    }

    public function count() {
        return $this->data->num_rows();
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function update($data = [], $id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function insert($data = []) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function set($data, $id) {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->insert($this->table);
    }

    public function getByEmail($email) {
        $this->db->select('*')->from($this->table);
        $this->db->where('email', $email);
        $this->data = $this->db->get();
        return $this;
    }

    public function searchUser($str) {
        $this->db->distinct();
        $this->db->select('tbl_user.id, username, email, mobile, address, city, birthday, tbl_user.status, tbl_user.disable, tbl_user.type, avatar, created_at, subdomain')->from($this->table);
        $this->db->join('tbl_website', 'tbl_user.id = tbl_website.IDuser', 'left');
        $this->db->like('username', $str);
        $this->db->or_like('email', $str);
        $this->db->or_like('city', $str);
        $this->db->limit(10);
        return $this->db->get()->result_array();
    }

}
