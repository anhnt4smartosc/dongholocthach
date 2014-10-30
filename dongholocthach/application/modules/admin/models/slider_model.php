<?php
/**
 * Created by PhpStorm.
 * User: MAI_ANH_VE
 * Date: 7/24/14
 * Time: 11:33 AM
 */
class slider_model extends CI_Model{
    protected $_table = "slider";
    protected $_primary = "slider_id";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function insertslider($data){
        $this->db->insert($this->_table,$data);
    }
    public function listslider(){
        $this->db->select('*');
        $this->db->join("product", "product.product_id=slider.product_id", "INNER");
        $this->db->order_by("slider.slider_position","ASC");
        return $this->db->get($this->_table)->result_array();
    }

    public function getslider($id)
    {
        $this->db->where("product_id",$id);
        return $this->db->get($this->_table)->row_array();
    }
    
    public function updateslider($key,$id,$data)
    {
        $this->db->where($key,$id);
        $this->db->update($this->_table,$data);
    }
    
    public function delete()
    {
        $this->db->empty_table($this->_table);
    }
    public function deleteSlider($id)
    {
        $this->db->where("product_id",$id);
        $this->db->delete($this->_table);
    }
}