<?php
class product_model extends CI_Model
{
    protected $_table = "product";
    protected $_primary = "product_id";
    public function __construct()
    {
        parent::__construct();
         $this->load->database();   
    }

    public function listProduct($limit=0,$start=0,$order = "",$order_opt = "",$category_id = "",$min_price=0,$max_price=0,$list_brand="")
    {
        $order = $order?$order:"product_date";
        $product_price = "`product_price` * (1 - `product_sale`/100)";
        $brand_id = "brand_id";

        if($category_id){
            $select = "P.product_id as product_id, ".
                "P.product_name as product_name, ".
                "P.product_date as product_date, ".
                "P.product_mainImageId as product_mainImageId, ".
                "P.product_price as product_price, ".
                "P.product_sale as product_sale";

            $this->db->select($select);
            $this->db->join("productcategory as PC","P.product_id = PC.product_id","INNER");
            $this->db->where("PC.category_id IN {$category_id} ");
            $this->db->group_by("PC.product_id");
            $product_price = "(P.product_price * (1 - P.product_sale/100))";
            //$product_price ="P.".$product_price;
            $brand_id ="P.".$brand_id;
            $order = "P.".$order;
            $this->_table = "product as P";
            $order_opt = $order_opt?$order_opt:"desc";
        }

        if($max_price>$min_price && $min_price>0)$this->db->where($product_price ." BETWEEN {$min_price} AND {$max_price}");
        if($list_brand) $this->db->where($brand_id." IN {$list_brand}");
        if($limit) $this->db->limit($limit,$start);
        $this->db->order_by($order,$order_opt);

        return $this->db->get($this->_table)->result_array();
    }




    public function get_product($id)
    {
        $this->db->where($this->_primary, $id);
        $query = $this->db->get($this->_table);
        $result = $query->row_array();
        return $result;
    }

    public function getImgProduct($id)
    {
        $this->db->select("image.image_path");
        $this->db->join("image", "product.product_id=image.product_id", "INNER");
        $this->db->where("product.product_id",$id);
        return $this->db->get($this->_table)->row_array();
    }

    public function getMainImg($main_image_id){
        $this->db->where("image_id",$main_image_id);
        return $this->db->get("image")->row_array();
    }
    public function getBrandProduct($id)
    {
        $this->db->select("brand.brand_name");
        $this->db->join("brand", "product.brand_id=brand.brand_id", "INNER");
        $this->db->where("product.product_id",$id);
        return $this->db->get($this->_table)->row_array();
    }

    public function getSlider(){
        $this->db->join("image","product_mainImageId = image.image_id");
        $this->db->join("slider","product.product_id = slider.product_id");
        $this->db->order_by("slider_position");
        return $this->db->get("product")->result_array();
    }

    public function detailProduct($id)
    {
        $this->db->where("product_id = $id");
        return $this->db->get($this->_table)->row_array();
    }

    public function get_main_image($id)
    {
        $this->db->where("image_id = $id");
        return $this->db->get("image")->row_array();
    }

    public function get_images($id)
    {
        $this->db->where("product_id = $id");
        return $this->db->get("image")->result_array();
    }

    public function get_brand($id)
    {
        $this->db->where("brand_id = $id");
        return $this->db->get("brand")->row_array();
    }

    public function get_rate_average($id)
    {
        $this->db->where("product_id = $id");
        $this->db->select_avg("comment_rate");
        $arr = $this->db->get("comment")->row_array();
        if($arr=='') return false;
        return $arr['comment_rate'];
    }

    public function get_num_rate($id)
    {
        $this->db->where("product_id = $id");
        return $this->db->count_all_results("comment");
    }
    public function insertComment($data =array())
    {
        $this->db->insert("comment",$data);
    }
    public function get_higest_product()
    {
        $this->db->order_by("product_price - product_price*product_sale/100","DESC");
        return $this->db->get($this->_table)->row_array();
    }
    public function get_lowest_product()
    {
        $this->db->order_by("product_price - product_price*product_sale/100","ASC");
        return $this->db->get($this->_table)->row_array();
    }
}