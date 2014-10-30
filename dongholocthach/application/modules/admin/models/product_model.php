<?php
///**
// * Created by PhpStorm.
// * User: anhnt01682
// * Date: 7/21/14
// * Time: 3:26 PM
// */
//
//class product_model extends CI_Model
//{
//    protected $_table = "product";
//    protected $_tableimage = "image";
//    protected $_primary = "product_id";
//    protected $_productname = "product_name";
//    protected $_productdesc = "product_desc";
//
//    public function __construct()
//    {
//        parent::__construct();
//        $this->load->database();
//    }
//
//    public function deleteProduct($id)
//    {
//        $this->db->where($this->_primary, $id);
//        $this->db->delete($this->_table);
//    }
//    public function listTest()
//    {
//        //        $this->db->select("product.product_id as product_id,
//        //                                                product_name,
//        //                                                product_date,
//        //                                                product_desc,
//        //                                                product_mainImageId,
//        //                                                product_price,
//        //                                                product_sale,
//        //                                                brand_id,
//        //                                                image.image_id as image_id,
//        //                                                image.image_path as image_path,
//        //                                                productcategory.category_id as category_id,
//        //                                                category.category_name");
//        //        $this->db->join("image","product.product_id = image.product_id", "left")
//        //                 ->join("productcategory","product.product_id = productcategory.product_id","right")
//        //                 ->join("category","category.category_id = productcategory.category_id");
//        return $array = $this->db->get($this->_table)->result_array();
//        $array_result = array();
//        //        foreach($array as $key => $product){
//        //            if(!array_key_exists($product['product_id'],$array_result)){
//        //                $array_result [$product['product_id']] = $product;
//        //                $array_result [$product['product_id']]['imgs'] = array();
//        //                $array_result [$product['product_id']]['categories'] = array();
//        //            }
//        //            if(!array_key_exists($product['image_id'],$array_result [$product['product_id']]['imgs'])){
//        //                $array_result [$product['product_id']]['imgs'][$product['image_id']] = $product['image_path'];
//        //            }
//        //
//        //
//        //            if(!array_key_exists($product['category_id'],$array_result [$product['product_id']]['categories'])){
//        //                $array_result [$product['product_id']]['categories'][$product['category_id']] = $product['category_name'];
//        //            }
//        //        }
//        //
//        //        return $array_result;
//    }
//    public function listProduct()
//    {
//        $this->db->order_by("product_date","DESC");
//        return $this->db->get($this->_table)->result_array();
//    }
//    public function searchProduct($search_name, $limit = "", $start = "")
//    {
//        $this->db->select('*');
//        $this->db->join("brand", "product.brand_id=brand.brand_id", "INNER");
//        $this->db->join("image", "product.product_mainImageId=image.image_id", "INNER");
//        if ($search_name != "") {
//            $this->db->like($this->_productname, $search_name);
//            $this->db->or_like($this->_productdesc, $search_name);
//            $this->db->or_like("brand.brand_name", $search_name);
//        }
//        $this->db->order_by("product_date","DESC");
//        if($limit) $this->db->limit($limit,$start);
//        return $this->db->get($this->_table)->result_array();
//    }
//    public function getSearchProduct($search_name, $limit = "", $start = "")
//    {
//        if ($search_name != "") {
//            $this->db->like($this->_productname, $search_name);
//            $this->db->or_like($this->_productdesc, $search_name);
//        }
//        $this->db->order_by("product_date","DESC");
//        if ($limit)
//            $this->db->limit($limit, $start);
//        return $this->db->get($this->_table)->result_array();
//    }
//
//    public function insert($data)
//    {
//        $this->db->insert($this->_table, $data);
//        return $this->db->insert_id();
//    }
//
//    public function update_mainImage($id, $imageId)
//    {
//        $this->db->where("product_id", $id);
//        $this->db->update($this->_table, array('product_mainImageId' => $imageId));
//    }
//
//    public function insert_image($data)
//    {
//        $this->db->insert("image", $data);
//        return $this->db->insert_id();
//    }
//
//    public function insert_procate($data)
//    {
//        $this->db->insert("productcategory", $data);
//    }
//
//    public function get_brand_list()
//    {
//        return $this->db->get("brand")->result_array();
//    }
//
//    public function get_category_list()
//    {
//        return $this->db->get("category")->result_array();
//    }
//    public function getImgProduct($id)
//    {
//        $this->db->select("image.image_path");
//        $this->db->join("image", "product.product_id=image.product_id", "INNER");
//        $this->db->where("product.product_id",$id);
//        return $this->db->get($this->_table)->row_array();
//    }
//    public function getBrandProduct($id)
//    {
//        $this->db->select("brand.brand_name");
//        $this->db->join("brand", "product.brand_id=brand.brand_id", "INNER");
//        $this->db->where("product.product_id",$id);
//        return $this->db->get($this->_table)->row_array();
//    }
//    public function reportProduct($datestart=0,$dateend=0,$limit=0,$start=0)
//    {
//        $this->db->select("a.*,c.order_date,SUM(b.order_quantity) as total ");
//        $this->db->from("product a");
//        $this->db->join("orderdetail b","a.product_id=b.product_id","INNER");
//        $this->db->join("order c","b.order_id=c.order_id","INNER");
//        if($datestart&&$dateend)
//        {
//            $this->db->where("c.order_date > $datestart AND c.order_date < $dateend");
//        }
//        $this->db->group_by("a.product_id");
//        $this->db->order_by("total DESC");
//        if($limit) $this->db->limit($limit,$start);
//        return $this->db->get()->result_array();
//    }
//
//    public function listSlider(){
//        $this->db->where("isSlider", 1);
//        return $this->db->get($this->_table)->result_array();
//    }
//    public function updateProductSlider($id,$data=array()){
//        $this->db->where($this->_primary,$id);
//        $this->db->update($this->_table,$data);
//    }
//    public function listID(){
//        $this->db->select('product_id');
//        return $this->db->get($this->_table)->result_array();
//    }
//    public function get_product($id)
//    {
//        $this->db->where($this->_primary, $id);
//        $query = $this->db->get($this->_table);
//        $result = $query->row_array();
//        return $result;
//    }
//    public function get_category($id)
//    {
//        $this->db->where($this->_primary, $id);
//        $query = $this->db->get('productcategory');
//        $result = $query->result_array();
//        return $result;
//    }
//    public function update_product($id, $data, $category=array(),$main_image = '' ,$up_image = '')
//    {
//        $this->db->where($this->_primary, $id);
//        $this->db->update($this->_table, $data  );
//        if(!empty($category)) {
//            $this->update_product_category($id, $category);
//        }
//        $image_id = '';
//        $image_id = (isset($main_image) && $main_image != '')?$main_image:$image_id;
//        $image_id = (isset($up_image) && $up_image != '')?$up_image:$image_id;
//
//        if($image_id) $this->update_product_image($id, $image_id);
//    }
//    /**
//     *  Upload batch set category id
//     * @id : product_id
//     * @category : set of category_id
//     */
//    protected function update_product_category($id, $category)
//    {
//        $this->delete_product_category($id);
//        foreach ($category as $ca) {
//            $this->insert_product_category($id, $ca);
//        }
//    }
//    protected function delete_product_category($id)
//    {
//        $this->db->where($this->_primary, $id);
//        $this->db->delete('productcategory');
//    }
//    protected function insert_product_category($id, $category_id)
//    {
//        $data = array();
//        $data['product_id'] = $id;
//        $data['category_id'] = $category_id;
//        $this->db->insert('productcategory', $data);
//        return $this->db->insert_id();
//    }
//    protected function update_product_image($id, $image_id)
//    {
//        $data = array (
//            'product_mainImageId'=> $image_id
//        );
//        $this->db->where($this->_primary, $id);
//        $this->db->update($this->_table, $data);
//    }
//}
?>
<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/21/14
 * Time: 3:26 PM
 */

class product_model extends CI_Model
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

    public function deleteProduct($id)
    {
        $this->db->where($this->_primary, $id);
        $this->db->delete($this->_table);
    }
    public function listTest()
    {
        $array = $this->db->get($this->_table)->result_array();
        foreach($array as $key=>$product){

            $image_path = $this->image_model->get_full_path($product['product_mainImageId']);
            $image_thumb_path = $this->image_model->has_thumb($product['product_mainImageId']);

            $array[$key]['main_image_path'] = $image_path;
            $array[$key]['main_image_path_thumb'] = $image_thumb_path;
        }
//        echo "<pre>";
//        print_r($array);
//        die();
        return $array;
    }
    public function listProduct()
    {
        $this->db->order_by("product_date","DESC");
        return $this->db->get($this->_table)->result_array();
    }
    public function searchProduct($search_name, $limit = "", $start = "")
    {
        $this->db->select('*');
        $this->db->join("brand", "product.brand_id=brand.brand_id", "INNER");
        $this->db->join("image", "product.product_mainImageId=image.image_id", "INNER");
        if ($search_name != "") {
            $this->db->like($this->_productname, $search_name);
            $this->db->or_like($this->_productdesc, $search_name);
            $this->db->or_like("brand.brand_name", $search_name);
        }
        $this->db->order_by("product_date","DESC");
        if($limit) $this->db->limit($limit,$start);
        return $this->db->get($this->_table)->result_array();
    }
    public function getSearchProduct($search_name, $limit = "", $start = "")
    {
        if ($search_name != "") {
            $this->db->like($this->_productname, $search_name);
            $this->db->or_like($this->_productdesc, $search_name);
        }
        $this->db->order_by("product_date","DESC");
        if ($limit)
            $this->db->limit($limit, $start);
        return $this->db->get($this->_table)->result_array();
    }

    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function update_mainImage($id, $imageId)
    {
        $this->db->where("product_id", $id);
        $this->db->update($this->_table, array('product_mainImageId' => $imageId));
    }

    public function insert_image($data)
    {
        $this->db->insert("image", $data);
        return $this->db->insert_id();
    }

    public function insert_procate($data)
    {
        $this->db->insert("productcategory", $data);
    }

    public function get_brand_list()
    {
        return $this->db->get("brand")->result_array();
    }

    public function get_category_list()
    {
        return $this->db->get("category")->result_array();
    }
    public function getImgProduct($id)
    {
        $this->db->select("image.image_path");
        $this->db->join("image", "product.product_id=image.product_id", "INNER");
        $this->db->where("product.product_id",$id);
        return $this->db->get($this->_table)->row_array();
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
        $this->db->select("a.*,c.order_date,SUM(b.order_quantity) as total ");
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

    public function listSlider(){
        $this->db->where("isSlider", 1);
        return $this->db->get($this->_table)->result_array();
    }
    public function updateProductSlider($id,$data=array()){
        $this->db->where($this->_primary,$id);
        $this->db->update($this->_table,$data);
    }
    public function listID(){
        $this->db->select('product_id');
        return $this->db->get($this->_table)->result_array();
    }
    public function get_product($id)
    {
        $this->db->where($this->_primary, $id);
        $query = $this->db->get($this->_table);
        $result = $query->row_array();
        return $result;
    }
    public function get_category($id)
    {
        $this->db->where($this->_primary, $id);
        $query = $this->db->get('productcategory');
        $result = $query->result_array();
        return $result;
    }
    public function update_product($id, $data, $category=array(),$main_image = '' ,$up_image = '')
    {
        $this->db->where($this->_primary, $id);
        $this->db->update($this->_table, $data  );
        if(!empty($category)) {
            $this->update_product_category($id, $category);
        }
        $image_id = '';
        $image_id = (isset($main_image) && $main_image != '')?$main_image:$image_id;
        $image_id = (isset($up_image) && $up_image != '')?$up_image:$image_id;

        if($image_id) $this->update_product_image($id, $image_id);
    }
    /**
     *  Upload batch set category id
     * @id : product_id
     * @category : set of category_id
     */
    protected function update_product_category($id, $category)
    {
        $this->delete_product_category($id);
        foreach ($category as $ca) {
            $this->insert_product_category($id, $ca);
        }
    }
    protected function delete_product_category($id)
    {
        $this->db->where($this->_primary, $id);
        $this->db->delete('productcategory');
    }
    protected function insert_product_category($id, $category_id)
    {
        $data = array();
        $data['product_id'] = $id;
        $data['category_id'] = $category_id;
        $this->db->insert('productcategory', $data);
        return $this->db->insert_id();
    }
    protected function update_product_image($id, $image_id)
    {
        $data = array (
            'product_mainImageId'=> $image_id
        );
        $this->db->where($this->_primary, $id);
        $this->db->update($this->_table, $data);
    }
}
