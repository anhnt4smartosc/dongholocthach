<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/24/14
 * Time: 9:11 AM
 */

class order extends BaseAdminController{
    protected $_value = array();
    protected $_error = array();
    public function __construct(){
        parent::__construct();
        $this->load->model("order_model");
        $this->load->model("orderdetail_model");
        $this->load->library('pagination');
    }

    public function config($total,$page){
        $config['base_url'] = base_url("admin/order/index/page");
        $config['total_rows'] = $total;
        $config['per_page'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 5;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_closed'] = '</ul>';
        $config['prev_tag_open'] = $config['first_tag_open'] = $config['next_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['cur_tag_open'] = "<li><a class='cur_page'>";
        $config['prev_tag_close'] = $config['first_tag_close'] = $config['next_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_close'] = "</a></li>";
        $config['next_link'] = 'Next →';
        $config['prev_link'] = '← Previous';
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $this->pagination->initialize($config);
    }

    public function index(){
        $data = array();
        $data['page_title'] = "Danh sách đơn hàng";
        $data['template'] = "order/list";
        $data['order_opt'] = $data['order'] = $data['search_date'] = $data['search_id'] = "";
        if($this->input->get("searchBtn")){
            $data['search_id'] = $search_id = $this->input->get("search_id");
            $data['search_date'] = $search_date = $this->input->get("search_date");
            $data['search_status'] = $search_status = $this->input->get("search_status");
            $data['order'] = $order = $this->input->get("order");
            $data['order_opt'] = $order_opt = $this->input->get("order_opt");
            $data['listOrder'] = $this->order_model->listOrder($search_id,$search_date,$search_status,$order,$order_opt);
        }else{
            $data['listOrder'] = $this->order_model->listOrder();
        }
        $page = $this->uri->segment(5)?$this->uri->segment(5):1;
        $totalRows = count($data['listOrder']);
        $this->config($totalRows,$page);

        $pagingArray = array();
        $start = ($page - 1) * $this->pagination->per_page;
        $end = ($start + $this->pagination->per_page < $totalRows)?$start + $this->pagination->per_page:$totalRows;

        for($i = $start; $i<$end;$i++){
            $pagingArray [] = $data['listOrder'][$i];
        }
        $data['listOrder'] = $pagingArray;
        $data["pager"] =  $this->pagination->create_links();
        $this->loadView("template/layout",$data);
    }
    public function view(){
        $id = $this->uri->segment(4);
        $data = array();
        $data['page_title'] = "Chi tiết đơn hàng";
        $data['template'] = "order/details";
        $data['order'] = $this->order_model->detailsOrder($id);
        $data['orderDetails'] = $this->orderdetail_model->getByOrderId($id);
        $this->loadView("template/layout",$data);
    }

    public function approve(){
        $id = $this->uri->segment(4);
        $testOrderObj = $this->order_model->detailsOrder($id);
        if($testOrderObj == null || $testOrderObj['order_status'] == 0){
            $this->order_model->updateOrder($id,1);
            redirect(base_url("admin/order/index"));
        }
    }

    public function finish(){
        $id = $this->uri->segment(4);
        $testOrderObj = $this->order_model->detailsOrder($id);
        if($testOrderObj == null || $testOrderObj['order_status'] == 1){
            $this->order_model->updateOrder($id,2);
            redirect(base_url("admin/order/index"));
        }
    }

    public function delete(){
        $id = $this->uri->segment(4);
        $testOrderObj = $this->order_model->detailsOrder($id);
        if($testOrderObj == null || $testOrderObj['order_status'] != 2){
            $this->order_model->deleteOrder($id);
            redirect(base_url("admin/order/index/"));
        }
        redirect(base_url("admin/order/index/"));
    }
} 