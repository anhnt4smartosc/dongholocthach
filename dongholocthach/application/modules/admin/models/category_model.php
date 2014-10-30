<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/21/14
 * Time: 9:25 AM
 */

class category_model extends CI_Model{
    protected $_table = "category";
    protected $_primary = "category_id";    
    protected $_table_procate = 'ProductCategory';

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function insertCategory($data){
        $this->db->insert($this->_table,$data);
    }
    public function listCategory(){
        return $this->db->get($this->_table)->result_array();
    }
    public function getCategory($id)
    {
        $this->db->where($this->_primary,$id);
        return $this->db->get($this->_table)->row_array();
    }
    public function validationCategory($id,$category_name){
        $category_name ="'".$category_name."'";
        $this->db->where("category_name =".$category_name);
        $this->db->where("category_id !=".$id);
        return $this->db->get($this->_table)->result_array();
    }
    public function updateCategory($id,$data)
    {
        $this->db->where($this->_primary,$id);
        $this->db->update($this->_table,$data);
    }
    public function delete($id,$option = "")
    {
        switch ($option)
        {
            case "":
            {   
                //lay id cate cha
                $this->db->where("category_id = $id");
                $cate = $this->db->get($this->_table)->row_array();
                $parent = $cate['category_parentId'];
                      
                                          
                //chuyen cac cate con vao cate cha
                $this->db->set('category_parentId',$parent);
                $this->db->where("category_parentId = $id");
                $this->db->update($this->_table);
                
                //chuyen cac product con vao cate cha
                $this->db->set('category_id',$parent);
                $this->db->where("category_id = $id");
                $this->db->update($this->_table_procate);   
                
                //delete cate
                $this->db->where("category_id = $id");
                $this->db->delete($this->_table);                           
            }
            break;
            case "deleteSubcate":
            {
                //xoa cac cate con  
                $this->db->where("category_parentId = $id");              
                $this->db->delete($this->_table);
                
                //xoa cate cua cac product con
                $this->db->where("category_id = $id");
                $this->db->set('category_id',null);
                $this->db->update($this->_table_procate);  
                
                //delete cate    
                $this->db->where("category_id = $id");            
                $this->db->delete($this->_table);        
            }  
            break;          
            default:
            {

                                           
                //chuyen cac cate con vao cate $option
                $this->db->where("category_parentId = $id");
                $this->db->set('category_parentId',$option);
                $this->db->update($this->_table);
                
                //chuyen cac product con vao cate $option
                $this->db->where("category_id = $id");
                $this->db->set('category_id',$option);
                $this->db->update($this->_table_procate); 
                
                //delete cate
                $this->db->where("category_id = $id");                
                $this->db->delete($this->_table);
            }
        }
    }
	
	public function updateMenu($sourceArr,$parents = null)
    {
        if(count($sourceArr)>0){
            foreach($sourceArr as $key => $value){
                $data = array('category_parentId'=>$parents);
                $this->db->where($this->_primary,$value['id']);
                $this->db->update($this->_table,$data);
                unset($sourceArr[$key]);
                $newparents = $value['id'];
                if(isset($value['children'])){
                    $this->updateMenu($value['children'],$newparents);
                }
            }
        }
    }
} 