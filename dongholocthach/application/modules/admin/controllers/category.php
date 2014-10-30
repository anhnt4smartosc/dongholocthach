<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/21/14
 * Time: 9:29 AM
 */

class category extends BaseAdminController{
    public function __construct(){
        parent::__construct();
        $this->load->model("category_model");
        $this->load->library("form_validation");
	    $this->load->library("mylibraries/mycategory");
    }
    public function index(){
        $listCategory = array();
        $listCategory = $this->category_model->listCategory();
        $data = array();
        $data['listCategory'] = $this->getTreeCate($listCategory,0,array());
        $data['template'] = "category/list";
        $data['page_title'] = "Danh sách danh mục";
        $this->loadView("template/layout",$data);
    }
    public function insert() {
        if($this->input->post("ok")){
            $this->form_validation->set_rules("category_name","Tên thành viên","trim|required");
            $this->form_validation->set_message("required","%s không thể rỗng");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            if($this->form_validation->run()){
                $dataCategory = array(
                    "category_name"=>$this->input->post("category_name"),
                    "category_parentId"=>$this->input->post("category_parentId"),
                );
                $dataCategory['category_parentId'] = $dataCategory['category_parentId']==0?NULL:$dataCategory['category_parentId'];
                $this->category_model->insertCategory($dataCategory);
                redirect(base_url("admin/category/index"));
                return;
            }
        }
        $data['listCategory'] = $this->category_model->listCategory();
        $data['listCategory'] = "<select name ='category_parentId'><option value='0'>Main Category</option>".$this->mycategory->selectMenu($data['listCategory'])."</select>";
        $data['page_title'] = "Thêm mới Category";
        $data['template'] = "category/insert";
        $this->loadView("template/layout",$data);
    }
    public function update($id) {
        $id = $this->uri->segment(4);
        if($id)
        {
            $dataCategory =$this->category_model->getCategory($id);
            if($this->input->post("btnok")){
                $this->form_validation->set_rules("category_name","Tên Category","trim|required");
                $this->form_validation->set_message("required","%s không thể rỗng");
                $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
                if($this->form_validation->run()){
                    $dataCategory = array(
                        "category_name"=>$this->input->post("category_name"),
                        "category_parentId"=>$this->input->post("category_parentId"),
                    );
                    if(count($this->category_model->validationCategory($id,$dataCategory['category_name']))>0)
                    {
                        $this->_error['category_name'] = "Tên Category đã có!";
                    }
                    else{
                        $dataCategory['category_parentId'] = $dataCategory['category_parentId']==0?NULL:$dataCategory['category_parentId'];
                        $this->category_model->updateCategory($id,$dataCategory);
                        redirect(base_url("admin/category/index"));
                        return;

                    }
                }
            }
            $data['category'] = $dataCategory;
            $data['listCategory'] = $this->category_model->listCategory();
            $data['listCategory'] = "<select name ='category_parentId'><option value='0'>Main Category</option>".$this->mycategory->selectedMenu($data['listCategory'],$data['category']['category_parentId'])."</select>";
            $data['page_title'] = "Sửa Category";
            $data['template'] = "category/update";
            $this->loadView("template/layout",$data);
        }
    }
    public function delete()
    {
        $id = $this->uri->segment(4);
        $option = $this->uri->segment(5);
        $this->category_model->delete($id,$option);
        redirect(base_url('/admin/category/index'));
    }

    public function getTreeCate($listCate = array(),$parentId = 0, $arrayValue = array()){
        $html = "";
        if(count($listCate) > 0){
            $html.="<ol class='dd-list'>";
            foreach($listCate as $Cate){
                if($Cate['category_parentId'] == $parentId){
                    $html.="<li class='dd-item' data-id=".$Cate['category_id'].">";
//                    $html.="<ul class='small-menu'>";
//                    $html.="<li>";
//                    $html.="<a href='".base_url("admin/category/update")."/".$Cate['category_id'];
//                    $html.="Chỉnh sửa</a></li><li>";
//                    $html.="<a class='delete_link' href='".base_url("admin/category/delete")."/".$Cate['category_id'];
//                    $html.="Xóa trang</a></li></ul>";
                    $html.="<div class='dd-handle'>".$Cate['category_name'];
                    $html.="<a style='float:right;padding-left:10px' href='".base_url("admin/category/update")."/".$Cate['category_id']."'>Chỉnh sửa</a>";
                    $html.="<a style='float:right;padding-left:10px' href='".base_url("admin/category/delete")."/".$Cate['category_id']."'>Xóa</a>";
                    $html.="</div>";
                    unset($cate);
                    $html.= $this->getTreeCate($listCate, $Cate['category_id'], $arrayValue);
                    $html.="</li>";
                }
            }
            $html.="</ol>";
        }
        return $html;
    }


	public function move() {
        $data['listCategory'] = $this->category_model->listCategory();
        $data['page_title'] = "Di chuyển category";
        $data['template'] = "category/move";
        $this->loadView("template/layout",$data);
    }
    public function moveCategory(){
        $data = isset($_POST['data'])?$_POST['data']:"";
        $data = json_decode($data,true);
        $this->category_model->updateMenu($data,null);
        $this->move();
        return;
    }
} 