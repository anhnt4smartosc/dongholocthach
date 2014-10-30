<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/20/14
 * Time: 11:27 PM
 */

class BasePublicController extends CI_Controller{
    protected $_infos = array();
    public function __construct(){
        parent::__construct();
        $this->load->library("session");
        $this->load->helper('url');
        $this->load->model('products_model');
        $this->load->model('brand_model');
    }

    public function loadView($url,$data = array()){
        if(isset($this->session->userdata['user']) && $this->session->userdata['user']!=null){
            $data['userAu'] = $this->session->userdata['user'];
        }
        $this->load->model("basic_page_model");
        $data['pageList'] = $this->basic_page_model->listPages();
        $data['listBrands'] = $this->listMenu($this->brand_model->listBrand());
        $data['listNewProducts'] = $this->getResizeList($this->products_model->listProducts(2,0,"",-1,"","","product_create_date"),'thumb');
        $data['bigBanner'] = base_url()."public/site-images/dongholocthach.jpg";
        $this->load->view($url,$data);
    }

    private function getResizeList($listProducts = array(), $resolution){
        if($resolution == 'thumb'){
            $resolution = '230x172';
        }
        else if($resolution == 'slide'){
            $resolution = '300x200';
        }
        foreach($listProducts as $key=>$product){
            $listProducts[$key]['product_main_image'] = $this->getThumb($resolution, $product['product_main_image']);
        }
        return $listProducts;
    }

    private function getThumb($resolution, $imageName){
        $arr = explode(".",$imageName);
        $arr[0] = $arr[0]."_thumb";
        return "$resolution/".implode('.', $arr);
    }

    private function listMenu($list = array()){
        $listBrand = "<ul>";
        foreach($list as $key=>$brand)
        {
            $listBrand.="<li>";
            $listBrand.="<a href='".base_url("default/home/brand")."/".$brand['brand_id']."'>".$brand['brand_name']."</a>";
            $listBrand.="</li>";

        }
        $listBrand.="</ul>";
        return $listBrand;
    }
}