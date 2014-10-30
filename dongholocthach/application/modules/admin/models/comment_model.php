<?php
class Comment_model extends CI_Model
{
    protected $_table = "comment";    

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function delete_comment($id)
    {
        $this->db->where('comment_id =', $id);
        $this->db->set('comment_status',0);
        $this->db->update($this->_table);
    }
    
    public function accept_comment($id)
    {
        $this->db->where('comment_id =', $id);
        $this->db->set('comment_status',2);
        $this->db->update($this->_table);
    }
    
    public function get_comment_list($display_option='', $search='')
    {        
        switch($display_option)
        {
            case 'new':
            {
                $this->db->where('comment_status = 1');
            }
            break;
            case 'deleted':
            {
                $this->db->where('comment_status = 0');                
            }
            break;
            case 'accepted':
            {
                $this->db->where('comment_status = 2');
            }
            break;
            default: break;
        }
        if($search!='')
        {
            $this->db->like("user_name", $search);
            $this->db->or_like("user_email", $search);
            $this->db->or_like("product_name", $search);
            $this->db->or_like("comment_detail", $search);
        }
        $arr = $this->db->get($this->_table)->result_array();
        if($arr==array()) return false;
        return $arr;
    }
    
    public function get_comments($id)
    {
        $this->db->where("product_id = ", $id);
        $arr = $this->db->get("comment")->result_array();
        if($arr=='') return false;
        return $arr;
    }
    
    public function get_products()
    {
        //kiem tra co comment nao chua
        if($this->db->count_all($this->_table)==0) return false;
        
        //lay danh sach cac san pham trong bang comment
        $this->db->distinct('product_id');
        $this->db->select('product_id');
        $this->db->order_by('product_id','asc');
        $pro_id = $this->db->get($this->_table)->result_array();
        
        //dem so comment cho moi san pham
        $this->db->order_by('product_id','asc');
        $this->db->group_by('product_id');
        $this->db->select('count(comment_id) as count');
        $pro_count = $this->db->get($this->_table)->result_array();
        
        foreach($pro_id as $value)
        {
            $key[] = $value['product_id'];
        }
        foreach($pro_count as $value)
        {
            $num[] = $value['count'];
        }
        //tao mang co key la product_id value la so comment va tra ve mang nay        
        return array_combine($key, $num);
    }
    
    public function get_product_name($id)
    {        
        $this->db->where('product_id =', $id);
        $this->db->select('product_name');
        $arr = $this->db->get('product')->result_array();
        if($arr==array()) return false;
        return $arr[0]['product_name'];
    }
        
    //public function get_comment_list($product_id, $start, $limit)
//    {        
//        $this->db->order_by('product_id','asc');
//        $this->db->where('product_id =', $product_id);
//        $this->db->limit($limit, $start);
//        $arr = $this->db->get($this->_table)->result_array();
//        if($arr==array()) return false;
//        return $arr;
//    }
}

