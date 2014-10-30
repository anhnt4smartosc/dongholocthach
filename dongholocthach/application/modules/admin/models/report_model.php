<?php

class report_model extends CI_Model
{
    protected $_table = "product";
    protected $_tableimage = "image";
    protected $_primary = "product_id";
    protected $_productname = "product_name";
    protected $_productdesc = "product_desc";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function getImgProduct($id)
    {
        $this->db->select("image.image_path");
        $this->db->join("image", "product.product_id=image.product_id", "INNER");
        $this->db->where("product.product_id",$id);
        return $this->db->get($this->_table)->row_array();
    }
    public function getCategory($id)
    {
        $this->db->select("a.*");
        $this->db->from("category a");
        $this->db->join("productcategory b", "a.category_id=b.category_id", "INNER");
        $this->db->where("b.product_id",$id);
        return $this->db->get()->result_array();
    }
    public function getBrandProduct($id)
    {
        $this->db->select("brand.brand_name");
        $this->db->join("brand", "product.brand_id=brand.brand_id", "INNER");
        $this->db->where("product.product_id",$id);
        return $this->db->get($this->_table)->row_array();
    }
    public function reportProduct($datestart=0,$dateend=0,$limit=0,$start=0)
    {
        $this->db->select("a.*,c.order_date,count(b.product_id) as total ");
        $this->db->from("product a");
        $this->db->join("orderdetail b","a.product_id=b.product_id","INNER");
        $this->db->join("order c","b.order_id=c.order_id","INNER");
        if($datestart&&$dateend)
        {
            $this->db->where("c.order_date > $datestart AND c.order_date < $dateend");
        }
        $this->db->group_by("a.product_id");
        $this->db->order_by("total DESC");
        if($limit) $this->db->limit($limit,$start);
        return $this->db->get()->result_array();
    }
    public function getReportCategory($datestart=0,$dateend=0)
    {
        $this->db->select("a.*,COUNT(a.category_id) as timebuy");
        $this->db->from("category a");
        $this->db->join("productcategory b","a.category_id=b.category_id","INNER");
        $this->db->join("orderdetail d","b.product_id=d.product_id","INNER");
        $this->db->join("order e","d.order_id=e.order_id","INNER");
        if($datestart && $dateend) $this->db->where("e.order_date >$datestart AND e.order_date <$dateend");
        $this->db->group_by("a.category_id");
        return $this->db->get()->result_array();
    }
    public function getAllCategory()
    {
        return $this->db->get("category")->result_array();
    }
    public function reportCategory($sourceArr,$column = 'category_parentId',$parents = 0,$level = 1,$befor ="")
    {
        $html ="";
        if(count($sourceArr)>0){
            foreach($sourceArr as $key => $value){
                // echo "<li><a href=''>".$value['category_name']."</a>";
                if($value['category_parentId'] == $parents){
                    $after =$befor."&nbsp&nbsp&nbsp&nbsp&nbsp";
                    $html .= "<option value='".$value['category_id']."'><a href=''>".$befor.$value['category_name']."</a></option>";
                    $newParents = $value['category_id'];
                    unset($sourceArr[$key]);
                    $html.=$this->selectMenu($sourceArr,$column,$newParents, $level + 1,$after);
                }
            }
        }
        return $html;
    }
}
