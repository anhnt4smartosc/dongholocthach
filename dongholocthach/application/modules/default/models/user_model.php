<?php

class User_model extends CI_Model {
    protected $_primary ;
    protected $_table;

    public function __construct()
    {
        $this->_primary = 'user_id';
        $this->_table = 'user';
    }
    public function login($id , $password , $email = '')
    {
        $this->db->select('*');
        if($email !== '' && $email != null) {
            $where = array('user_email' => $email);
        }else $where = array('user_name' => $id);
        $where['user_password'] = $password;
        $this->db->where($where);
        $query = $this->db->get($this->_table);
        $result = $query->row_array();
        if($query->num_rows() >= 1){
            return $result;
        }else{
            return false;
        }
    }
}