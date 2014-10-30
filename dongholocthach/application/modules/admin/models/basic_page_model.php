<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 8/2/14
 * Time: 10:09 AM
 */

class basic_page_model extends CI_Model{
    protected $_table = "basic_pages";
    protected $_primary = "basic_page_id";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function listPages(){
        $this->db->order_by("basic_page_index");
        return $this->db->get($this->_table)->result_array();
    }

    public function insert($data = array()){
        $this->db->insert($this->_table,$data);
    }

    public function getPage($id){
        $this->db->where($this->_primary, $id);
        return $this->db->get($this->_table)->result_array()[0];
    }

    public function updatePage($id,$data = array()){
        $this->db->where($this->_primary, $id);
        $this->db->update($this->_table, $data);
    }

    public function deletePage($id){
        $this->db->where($this->_primary, $id);
        $this->db->delete($this->_table);
    }


}