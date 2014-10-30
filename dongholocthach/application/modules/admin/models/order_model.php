<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/24/14
 * Time: 9:11 AM
 */

class order_model extends CI_Model{

    protected $_table = "order";
    protected $_primary = "order_id";


    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listOrder($id = "", $date = "",$status="", $order = "",$order_opt = ""){
        if($id)
            $this->db->where($this->_primary,$id);
        if($date)
            $this->db->where("order_date", $date);
        if($status!="" && $status!=-1)
            $this->db->where("order_status", $status);


        if($order){
            $order_opt = $order_opt?$order_opt:"asc";
            $this->db->order_by($order,$order_opt);
        }
        return $this->db->get($this->_table)->result_array();
    }

    public function detailsOrder($id){
        $this->db->where($this->_primary,$id);
        $orderObj = $this->db->get($this->_table)->result_array()[0];
        return $orderObj;
    }

    public function updateOrder($id,$status){
        $data = array(
            "order_status" => $status
        );
        $this->db->where($this->_primary, $id);
        $this->db->update($this->_table,$data);
    }

    public function deleteOrder($id){
        $this->db->where($this->_primary, $id);
        $this->db->delete($this->_table);
    }
} 