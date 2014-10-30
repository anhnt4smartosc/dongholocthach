<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/17/14
 * Time: 10:27 AM
 */

class brand extends BaseAdminController{

    public function __construct(){
        parent::__construct();
        $this->load->model("brand_model");
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

    public function index(){
        $config['base_url'] = base_url("admin/brand/index/page");
        $data = array();
        if(isset($_GET['btnSearch'])){
            $name_value = isset($_GET['search_value']) && $_GET['search_value']?$_GET['search_value']:"";
            $data['search_value'] = $name_value;
            $sort = isset($_GET['sort']) && $_GET['sort']?$_GET['sort']:"";
            $data['sort'] = $sort;

            $data['listBrand'] = $this->brand_model->listBrand($name_value,$sort);
        }
        else {
            $data['listBrand'] = $this->brand_model->listBrand("","");
        }
        $config['total_rows'] = count($data['listBrand']);
        $config['per_page'] = 4;
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

        $page = $this->uri->segment(5)?$this->uri->segment(5):1;
        $sort = $this->uri->segment(6)?$this->uri->segment(6):"brand_id";

        $this->pagination->initialize($config);

        $pagingArray = array();
        $start = ($page - 1) * $this->pagination->per_page;
        $end = ($start + $this->pagination->per_page < count($data['listBrand']))?$start + $this->pagination->per_page:count($data['listBrand']);

        for($i = $start; $i<$end;$i++){
                 $pagingArray [] = $data['listBrand'][$i];
        }

        $data['listBrand'] = $pagingArray;
        //$data['listBrand'] = $this->brand_model->listBrandLimit($this->pagination->per_page,($page - 1)*$this->pagination->per_page,$sort,$name_value);
        $data['template'] = "brand/list";
        $data["pager"] =  $this->pagination->create_links();
        $data["page_title"] =  "Danh sách các hãng";
        $this->loadView("template/layout",$data);
    }


    public function edit()
    {
        $id = (int)$this->uri->segment(4);
        $eror = false;
        if (true) $eror = true;
        if (!$id || $id == null
        ) redirect(base_url().'admin/brand/');
        $data['success'] = 0;
        if ($_POST) {
            $error = false;
            if(!$_POST['brand_name']) {
                $errorName = 'Name must not empty';
                $error = true;
            }
            if (!$error){
                $data_post = array(
                    'brand_name'	=>	$_POST['brand_name'],
                    'brand_desc'	=>	$_POST['brand_desc']
                );

                $this->brand_model->updateBrand($id,$data_post);
//
                $data['success'] == 1;
                redirect(base_url("admin/brand/index"));
                return;
//
            }
        }
        if ($data['success'] == 0) {
            // load library for form
            if(isset($errorName)) {
                $data['errorName'] = $errorName;
            }
            $this->load->helper('form');
            //$this->load->view('templates/header');
            $data['brand'] = $this->brand_model->get_brand($id);
            $data['template'] = "brand/edit";
            $data['page_title'] = "Chỉnh sửa hãng";
            $data['error'] = $eror;
            $this->loadView("template/layout",$data);
        }
    }
    public function delete()
    {
        echo '<script>
        alert("Các sản phẩm thuộc nhãn hàng này có thể không được cập nhập hãng");
        </script>';
        $id = $this->uri->segment(4);
        $this->brand_model->delete_brand($id);
        redirect(base_url()."admin/brand/index");
    }

    public function searchBrand(){
        //$search = $this->input->post('search');
        //$query = $this->brand_model->getBrandSearch($search);
        //echo json_encode($query);
        $params = $_REQUEST;
        $query = array();

        if(isset($_POST['btnsearch'])){
            $query["result"] = $this->brand_model->getBrandSearch($params['txtsearch']);
        }
        $this->loadView("brand/search",$query);
    }

    public function insert(){
        if($this->input->post("btnOk")){
            $this->form_validation->set_rules("brand_name","Tên hãng","trim|required");
            $this->form_validation->set_rules("brand_desc","Miêu tả","max_length[255]");

            $this->form_validation->set_message("required","%s không thể rỗng");
            $this->form_validation->set_message("max_length","%s không được lớn hơn %d ký tự");

            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            if($this->form_validation->run()){
                $datas = array(
                    'brand_name' => $this->input->post("brand_name"),
                    'brand_desc' => $this->input->post("brand_desc")
                );
                $this->brand_model->insertBrand($datas);
                $this->session->set_flashdata('message', '<b>Thêm mới thành công hãng '.$datas['brand_name'].'</b>');
                redirect(base_url("admin/brand/insert"));
            }
        }
        $data = array(
            'template' => 'brand/add',
            'page_title' => 'Thêm mới hãng'
        );
        $this->loadView("template/layout",$data);
    }
}
