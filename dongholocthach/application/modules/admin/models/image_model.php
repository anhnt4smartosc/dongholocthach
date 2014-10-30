<?php

class image_model extends CI_Model
{
    protected $_table;
    protected $_primary;
    protected $_basepath;
    protected $_realpath;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->_primary = 'image_id';
        $this->_table = 'image';
        $this->_realpath = realpath(APPPATH. '../public/admin/images/');
        $this->_basepath = base_url(). 'public/admin/images/';
    }

    public function get()
    {
        $query = $this->db->get($this->_table);
        $result = $query->result_array();
        return $result;
    }
    public function get_image($id)
    {
        $this->db->where($this->_primary, $id);
        $query = $this->db->get($this->_table);
        $result = $query->row_array();
        return $result;
    }
    public function get_path_image($id)
    {
        $this->db->select('image_path');
        $this->db->where($this->_primary, $id);
        $query = $this->db->get($this->_table);
        $result = $query->row_array();
        if (isset($result) && $result != null && isset($result['image_path'])) return $result['image_path'];
        return false;
    }
    public function get_product_id($id)
    {
        $this->db->select('product_id');
        $this->db->where($this->_primary, $id);
        $query = $this->db->get($this->_table);
        $result = $query->row_array();
        if (isset($result) && $result != null && isset($result['product_id'])) return $result['product_id'];
        return false;
    }
    public function get_name($name)
    {

    }
    public function insert($data) {
        $this->db->insert($this->_table, $data);
        return  $this->db->insert_id();
    }
    public function get_upload_forder($id)
    {
        $ret = $this->_basepath  . 'product/';
        $ret .= $this->get_product_id($id). '/';
        return $ret;
    }
    public function get_full_path($id)
    {
        $ret = $this->get_upload_forder($id);
        $ret .= $this->get_path_image($id);
        $realpath = $this->_realpath . '/product/' . $this->get_product_id($id) . '/';
        $realpath .= $this->get_path_image($id);
        $realpath = realpath($realpath);
        //echo $realpath;
        if (!file_exists($realpath)) {
            $ret = base_url();
            $ret .= 'public/admin/images/';
            $ret .= $this->get_path_image($id);
        }
        return $ret;
    }
    public function get_full_real_path($id)
    {
        $realpath = $this->_realpath . '/product/' . $this->get_product_id($id) . '/';
        $realpath .= $this->get_path_image($id);
        $realpath = realpath($realpath);
        if (!file_exists($realpath)){
            $realpath = $this->_realpath;
            $realpath .= '/product/images/';
            $realpath .= $this->get_path_image($id);
        }
        if(!file_exists($realpath)) return false;
        else
            return realpath ($realpath);
    }
    public function get_image_product($product_id, $where = '')
    {
        // select * from image where product_id = $product_id;
        $this->db->where('product_id', $product_id);
        if ($where) $this->db->where($where);
        $query = $this->db->get($this->_table);
        $result = $query->result_array();
        return $result;
    }
    public function remove_img($id)
    {
        $path = $this->get_full_real_path($id);
        if(!file_exists($path))
        {
            return 'Error: file nay ko ton tai tren server';
        }
        $t_path = $path;
        $t_path = explode(".", $path);
        $ext = end($t_path);
        array_pop($t_path);
        $t_path = implode(".", $t_path);
        $t_path .= '_thumb.'. $ext;
        if(is_file($t_path))@unlink($t_path);
        @unlink($path);
        return true;
    }
    public function has_thumb($id)
    {
        $thumb = realpath($this->get_full_real_path($id));
        $thumb = explode('.', $thumb);
        $type = array_pop($thumb);
        $thumb = implode('.', $thumb);
        $thumb .= '_thumb.' .$type ;
        if(file_exists($thumb)) {
            $thumb = str_replace($this->_realpath, $this->_basepath, $thumb);
            $thumb = str_replace('/\\', '/', $thumb);
            $thumb = str_replace('\\', '/', $thumb);
            return $thumb;
        } else  {
            return false;
        }
    }
    public function get_image_properties($id, $path='')
    {
        // using gd library
        /* @var $m_path type */
        $m_path ='';
        if (!isset($id) && $id == null )
        {
            if ($path !== '') {
                $m_path = $path;
            } else {
                $data = array();
                $data['error'] = 'Không có đường dẫn hoặc id phù hợp!';
                $data['status'] = FALSE;
                return $data;
            }
            $m_path = $this->get_full_real_path($id);
            if (!file_exists($m_path))
            {
                $data['result'] = '';
                $data['error'] = 'Không có đường dẫn hoặc id phù hợp!';
                $data['status'] = FALSE;
                return $data;
            }

            // new section
            /* @var $vals type */
            $vals = getimagesize($m_path);
            $types=array(1=>'gif',2=>'jpeg',3=>'png');
            $mime = (isset($types[$vals['2']]))?'image/'.$types[$vals['2']] : 'image/jpg';
            $v['width']                            = $vals['0'];
            $v['height']                           = $vals['1'];
            $v['image_type']                  = $vals['2'];
            $v['size_str']                        =$vals['3'];
            $v['mime_type']                     = $mime;

            $data['result']=$v;
            $data['error']='';
            $data['status'] = TRUE;

            return $data;
        }
    }
    public function delete_image_product($id, $product_id = '')
    {
        $where = array(
            $this->_primary => $id
        );
        if (isset($product_id) && $product_id ) {
            $where['product_id']=$product_id;
        }
        $this->db->delete($this->_table, $where);
    }
}