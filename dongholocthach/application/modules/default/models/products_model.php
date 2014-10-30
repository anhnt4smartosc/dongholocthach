<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 8/11/14
 * Time: 11:48 AM
 */

class products_model extends CI_Model{
    protected $_table = "products";
//    protected $_tableimage = "image";
    protected $_primary = "product_id";

    public function getProduct($product_id){
        $this->db->where($this->_primary,$product_id);
        $product = $this->db->get($this->_table)->result_array()[0];
        return $product;
    }

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listProducts($limit = "", $start = "", $product_name = "", $brand_id = -1,$min_price = "", $max_price = "", $order = "product_create_date",$order_opt = "desc"){

        if($order == "product_price"){
            $order = "product_price *(1 - product_sale/100)";
        }
        $this->db->order_by($order,$order_opt);

        if($limit)
            $this->db->limit($limit, $start);
        if($product_name)
            $this->db->like("product_name", $product_name);
        if($brand_id && $brand_id != -1)
            $this->db->where("brand_id", $brand_id);
        if($min_price && $max_price)
            $this->db->where("product_price *(1 - product_sale/100) >= $min_price AND product_price *(1- product_sale/100) <= $max_price");
        $this->db->order_by("product_create_date","desc");
        return $this->db->get($this->_table)->result_array();
    }

    public function listProductsNumRows($limit = "", $start = "", $product_name = "", $brand_id = -1,$min_price = "", $max_price = "", $order = "product_create_date",$order_opt = "desc"){
        if($order == "product_price"){
            $order = "product_price *(1 - product_sale/100)";
        }
        $this->db->order_by($order,$order_opt);
        if($limit)
            $this->db->limit($limit, $start);
        if($product_name)
            $this->db->like("product_name", $product_name);
        if($brand_id && $brand_id != -1)
            $this->db->where("brand_id", $brand_id);
        if($min_price && $max_price)
            $this->db->where("product_price *(1 - product_sale/100) >= $min_price AND product_price *(1- product_sale/100) <= $max_price");
        $this->db->order_by("product_create_date","desc");
        return $this->db->get($this->_table)->num_rows();

    }
    public function getMinPrice($brand_id = -1){
        if($brand_id != -1){
            $this->db->where("brand_id",$brand_id);
        }
        $this->db->order_by("(product_price * (1 - product_sale/100))");
        $product = $this->db->get($this->_table,1,0)->row_array();
        return $product['product_price'] * (1 - $product['product_sale']/100);
    }
    public function getMaxPrice($brand_id = -1){
        if($brand_id != -1){
            $this->db->where("brand_id",$brand_id);
        }
        $this->db->order_by("(product_price * (1 - product_sale/100))","desc");
        $product = $this->db->get($this->_table,1,0)->row_array();
        return $product['product_price'] * (1 - $product['product_sale']/100);
    }

    public function listSale(){
        $this->db->where("product_sale > 0 AND product_sale < 100");
        $this->db->order_by("product_sale","desc");
        return $this->db->get($this->_table)->result_array();
    }

    public function insertProduct($product = array()){
        $this->db->insert($this->_table,$product);
    }

    public function updateProduct($product_id, $product = array()){
        $this->db->where($this->_primary,$product_id );
        $this->db->update($this->_table,$product);
    }

    public function deleteProduct($product_id){
        $product = $this->getProduct($product_id);
        $this->db->where($this->_primary, $product_id);
        $this->db->delete($this->_table);
        $image_path =  "public/products/images/".$product['product_main_image'];
        echo $image_path;
        unlink($image_path);
    }

} 