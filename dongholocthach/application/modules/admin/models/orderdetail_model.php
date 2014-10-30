<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/24/14
 * Time: 2:07 PM
 */

class orderdetail_model extends CI_Model{
    protected $_table = "orderdetail";
    protected $_primary = "orderdetail_id";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getByOrderId($id) {
        $this->db->join("product","product.product_id = orderdetail.product_id");
        $this->db->where("order_id",$id);
        return $this->db->get($this->_table)->result_array();
    }
} 