<?php
class Comment extends BaseAdminController
{    
    protected $list_comment = array();
    protected $display_option = '';
    protected $search = '';
    protected $comment_id_delete = array();
    protected $page;
    protected $row_per_page = 1;
    
    public function  __construct()
    {
        parent::__construct();
        $this->load->model("comment_model");
        $this->load->library("pagination");
        $this->load->helper("url");    
        $this->load->library("form_validation");                       
    }
    
    public function delete($id)
    { 
        if ($id == '' || $id == null) echo "error";
        $this->comment_model->delete_comment($id);
    }
    
    public function accept($id)
    { 
        if ($id == '' || $id == null) echo "error";
        $this->comment_model->accept_comment($id);
    }
    
    public function index()
    {        
        $this->display_option = $this->display_option=='' ? 'new' : $this->display_option;   
        $this->list_comment = $this->comment_model->get_comment_list($this->display_option,$this->search);
        if($this->input->post("btnok"))
        {
            $this->display_option = $this->input->post("display_option");
            $this->search = $this->input->post("search");
            $this->comment_id_delete = $this->input->post("delete");                
            $this->list_comment = $this->comment_model->get_comment_list($this->display_option,$this->search); 
            switch($this->display_option)
            {
                case 'new':
                if($this->list_comment!=false&&$this->comment_id_delete!='') foreach($this->list_comment as $key=>$value)
                {
                    if(in_array($value['comment_id'],$this->comment_id_delete))
                    {
                        $this->delete($value['comment_id']);                       
                    }
                    else
                    {
                        $this->accept($value['comment_id']);
                    }
                } 
                break;
                default:
                if($this->list_comment=='') echo "ma no";
                if($this->list_comment!=false&&$this->comment_id_delete!='') foreach($this->list_comment as $key=>$value)
                {
                    if(in_array($value['comment_id'],$this->comment_id_delete))
                    {
                        if($value["comment_status"]!=0) $this->delete($value['comment_id']);
                    }
                    else
                    {
                        if($value['comment_status']==0) $this->accept($value['comment_id']);
                    }                    
                } 
            }
            $this->list_comment = $this->comment_model->get_comment_list($this->display_option,$this->search); 
        }
        
        $data['display_option'] = $this->display_option;
        $data['search'] = $this->search;
        $data['list_comment'] = $this->list_comment;
        if($this->list_comment==false) 
        {
            $data['error'] = "Không có comment nào!";            
        } 
        $data['page_title'] = "Quản lý comment";
        $data['template'] = "comment/comment";
        
        $this->loadView("template/layout", $data);  
    }
    
    //public function next_product()
//    {        
//        next($this->products);
//        $this->current_product = key($this->products);
//        redirect(base_url("admin/comment/index/$this->current_product/")); 
//    }
//    
//    public function prev_product()
//    {        
//        prev($this->products);
//        $this->current_product = key($this->products);
//        redirect(base_url("admin/comment/index/$this->current_product/"));
//    }
//    
//    public function first_product()
//    {        
//        reset($this->products);
//        $this->current_product = key($this->products);
//        redirect(base_url("admin/comment/index/$this->current_product/"));
//    }
//    
//    public function last_product()
//    {        
//        end($this->products);
//        $this->current_product = key($this->products);
//        redirect(base_url("admin/comment/index/$this->current_product/"));
//    }

    //public function index()
//    {
//        $error = '';
//        $this->page = $this->uri->segment(5);
//        $this->page = isset($this->page) && $this->page!='' ? $this->page : 1;
//        if($this->products==false) $error = "Chua co comment nao!";
//        else while(1)
//        {
//            $this->current_product = $this->uri->segment(4);
//            $this->current_product = $this->current_product=='' ? key($this->products) : $this->current_product;
//            $data['product_name'] = $this->comment_model->get_product_name($this->current_product);
//            if($data['product_name']==false) 
//            {
//                $error = "Khong co product nao nhu vay!";
//                break;
//            }
//            
//            //lay cac comment cua trang dang hien thi
//            if(!key_exists($this->current_product,$this->products))
//            {
//                $error = "Chua co comment nao cho san pham nay!";
//                break;
//            }
//            $config['total_row'] = $this->products[$this->current_product];
//            $config['per_page'] = $this->row_per_page;
//            $config['next_link'] = 'Next';
//            $config['prev_link'] = 'Prev';
//            $config['num_links'] = 2;
//            $config['use_page_numbers'] = true;
//            $config['first_link'] = 'First';
//            $config['last_link'] = 'Last';
//            $config['base_url'] = base_url("admin/comment/index/product/$this->current_product");
//            
//            $this->pagination->initialize($config);
//            
//            
//            $this->page = (($this->page - 1)*$config['per_page'] > $config['total_row']) ? 
//            (int)ceil($config['total_row']/$config['per_page']) : $this->page;
//            $start = ($this->page - 1)*$config['per_page'];
//            $limit = ($this->page*$config['per_page']) < $config['total_row'] ? $config['per_page']
//            : $config['total_row']-$start;
//            $data['list_comment'] = $this->comment_model->get_comment_list($this->current_product,$start,$limit);
//            break; 
//        }
//        
//        
//            
//        $data['error'] = $error;  
//        $data['pages'] = $this->pagination->create_links();
//        $data['template'] = "comment/comment";
//        $data['page_title'] = "Quản lý comment";        
//        $this->loadView("template/layout", $data);
//    }

        

}