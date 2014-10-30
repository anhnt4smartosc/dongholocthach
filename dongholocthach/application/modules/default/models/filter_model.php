<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/17/14
 * Time: 10:29 AM
 */

class filter_model extends CI_Model{
    protected $_tblBrand = "brand";
    protected $_tblProduct = "product";
    protected $_primary_tblBrand = "brand_id";
    protected $_primary_tblProduct = "product_id";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listBrand($name_value="",$sort=""){
        $data = array();
        $this->db->like("brand_name",$name_value);
        if($sort) $this->db->order_by($sort);
        return $this->db->get($this->_tblBrand)->result_array();
    }

    public function listBrandLimit($limit,$start,$sort,$name_value=""){
        $data = array();
        if($name_value) $this->db->like("brand_name",$name_value);
        $this->db->order_by($sort);
        return $this->db->get($this->_tblBrand,$limit,$start)->result_array();
    }

    public function get_brand($id)
    {
        $this->db->where($this->_primary_tblBrand ,  $id);
        $result = $this->db->get('brand');
        return $result->row_array();
    }
    public function updateBrand($id, $data)
    {
        $this->db->where('brand_id' ,$id);
        $result = $this->db->update($this->_tblBrand, $data);
        return $result;
    }
    public function delete_brand($id)
    {
        $this->db->where("brand_id = $id");
        return $this->db->delete($this->_tblBrand);

    }

    public function getAllBrand(){
        return $this->db->get($this->_tblBrand)->result_array();
    }
    public function filterProduct($id,$min,$max){
        $this->db->select('*');
        $this->db->join("product", "product.brand_id=brand.brand_id", "INNER");
        $this->db->join("image", "product.product_id=image.product_id", "INNER");
        $this->db->where("brand.brand_id = $id");
        $this->db->where("product.product_price <= $max");
        $this->db->where("product.product_price >= $min");
        return $this->db->get($this->_tblBrand)->result_array();
    }
    public function getMinPrice(){
        $this->db->select('product_price');
        $this->db->order_by("product_price","ASC");
        return $this->db->get($this->_tblProduct)->result_array();
    }
    public function getMaxPrice(){
        $this->db->select('product_price');
        $this->db->order_by("product_price","DESC");
        return $this->db->get($this->_tblProduct)->result_array();
    }
}