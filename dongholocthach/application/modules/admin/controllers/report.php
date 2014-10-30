<?php
/**
 * controller :report
 * description: report best selling product and category between to date
 * author: Danglv FR05
 */
class report extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("pages");
        $this->load->model("report_model");
        $this->load->library("form_validation");
        $this->load->library("pages");
    }
    public function index(){
        $this->reportproduct();
    }
/**
 * function :reportproduct
 * description: show best selling product between to date
 * author: Danglv FR05
 */
    public function reportproduct($data=array())
    {
        if(!empty($data))
        {
            foreach($data['listproduct'] as $key=>$value )
            {
                $info = $this->report_model->getImgProduct($data['listproduct'][$key]['product_id']);
                $data['listproduct'][$key]['image_path'] = $info['image_path'];
                $info = $this->report_model->getBrandProduct($data['listproduct'][$key]['product_id']);
                $data['listproduct'][$key]['brand_name'] = $info['brand_name'];
            }
            $data['page_title'] = "Best-selling Product";
            $data['template'] = "report/reportproduct";
            $this->loadView("template/layout",$data);
        }
        else{
            $data['datestart']=$data['dateend']=0;
            $data['listproduct'] = $this->report_model->reportProduct();
            if($this->input->post("btnok")){
                $info = $this->getDate();
                $data['datestart']=$info['datestart'];
                $data['dateend']=$info['dateend'];
                $data['listproduct'] = $this->report_model->reportProduct($data['datestart'],$data['dateend']);
            }
            $data['limit'] = 1;
            $total = count($data['listproduct']);
            $data['page'] = isset($_POST['page']) ? $_POST['page'] : 1;
            $data['numpage'] = ceil($total / $data['limit']);
            $data['start'] = ($data['page'] - 1) * $data['limit'];
            $url = base_url();
            $data['pages'] = $this->pages->pageReportProduct($data['numpage'],$url,$data['datestart'],$data['dateend']);
            $this->pageproduct($data);
        }
    }
    public function pageproduct($data)
    {
        $data['listproduct'] = $this->report_model->reportProduct($data['datestart'],$data['dateend'],$data['limit'],$data['start']);
        $this->reportproduct($data);
    }
/**
 * function :ajaxReportProduct
 * description: ajax to pagination best selling product between to date
 * author: Danglv FR05
 */
    public function ajaxReportProduct()
    {
        $data['limit'] = 1;
        $page = $this->input->post('page')? $this->input->post('page') : 1;
        $data['start'] = ($page - 1) * $data['limit'];
        $data['datestart']=isset($_POST['datestart'])?$_POST['datestart']:0;
        $data['dateend']=isset($_POST['dateend'])?$_POST['dateend']:0;
       // $data['dateend']=$info['dateend'];
        $list = $this->report_model->reportProduct($data['datestart'],$data['dateend'],$data['limit'],$data['start']);
        foreach($list as $key=>$value )
        {
            $info = $this->report_model->getImgProduct($list[$key]['product_id']);
            $list[$key]['image_path'] = $info['image_path'];
            $info = $this->report_model->getBrandProduct($list[$key]['product_id']);
            $list[$key]['brand_name'] = $info['brand_name'];
            $list[$key]['datestart'] = $data['datestart'];
        }
        echo json_encode($list);
    }
/**
 * function :reportcategory
 * description: show best selling category between to date
 * author: Danglv FR05
 */
    public function reportcategory(){
        $data['datestart']=$data['dateend']=0;
        $info = $this->report_model->getReportCategory();
        if($this->input->post("btnok")){
            $info = $this->getDate();
            $data['datestart']=$info['datestart'];
            $data['dateend']=$info['dateend'];
            $info = $this->report_model->getReportCategory($data['datestart'],$data['dateend']);
        }
        $category = $this->report_model->getAllCategory();
        foreach($category as $key=>$value)
        {
            $category[$key]['timebuy'] =isset($category[$key]['timebuy'])?$category[$key]['timebuy']:0;
            foreach($info as $key_i=>$value_i)
            {
                if($category[$key]['category_id']==$info[$key_i]['category_id'])
                    $category[$key]['timebuy'] = $info[$key_i]['timebuy'];
            }
        }
        foreach($category as $key=>$value)
        {
            $category[$key]['timebuy']+=$this->totalSubCategory($category,$category[$key]['category_id']);
        }
        $category = $this->sortCategory($category);
        $data['listcategory'] = array();
        foreach($category as $key=>$value)
        {
            if($category[$key]['timebuy']>0) $data['listcategory'][]=$category[$key];
        }
        $data['limit'] = 1;
        $total = count($data['listcategory']);
        $data['page'] = isset($_POST['page']) ? $_POST['page'] : 1;
        $data['numpage'] = ceil($total / $data['limit']);
        $data['start'] = ($data['page'] - 1) * $data['limit'];
        $url = base_url();
      /*  $allcate = $this->report_model->getAllCategory();
        echo"<pre>";
        print_r($info);
        //print_r($allcate);
        $data['listcategory']=$this->listCategory($info,$allcate);
        foreach($data['listcategory'] as $key=>$value)
        {
            $data['listcategory'][$key]['category_parentId'] = $data['listcategory'][$key]['category_parentId']?$data['listcategory'][$key]['category_parentId']:0;
            $data['listcategory'][$key]['timebuy']+=$this->totalSubCategory($data['listcategory'],$data['listcategory'][$key]['category_id']);
        }*/
        $data['listcategory'] = $this->sortCategory($data['listcategory']);
        $data['page_title'] = "Best-selling Category";
        $data['template'] = "report/reportcategory";
        $this->loadView("template/layout",$data);
    }
    public function sortCategory($data = array())
    {
        $temp=array();
        for($i=0;$i<count($data);$i++)
            for($j=$i+1;$j<count($data);$j++)
                if($data[$i]['timebuy']<$data[$j]['timebuy'])
                {
                    $temp = $data[$i]['timebuy'];
                    $data[$i]['timebuy'] = $data[$j]['timebuy'];
                    $data[$j]['timebuy'] = $temp;
                }
        return $data;
    }
    public function totalSubCategory($data,$parents = 0)
    {
        $timebuy = 0;
        if(count($data)>0){
            foreach($data as $key => $value){
                if($value['category_parentId'] == $parents){
                    if(!($this->checklastchild($value,$data))) return $value['timebuy'];
                    $newParents = $value['category_id'];
                    unset($data[$key]);
                    $timebuy+=$this->totalSubCategory($data,$newParents);
                }
                else unset($data[$key]);
            }
        }
        return $timebuy;
    }
    public function checklastchild($info,$data)
    {
        foreach($data as $key=>$value){
            if($data[$key]['category_parentId']==$info['category_id']) return false;
        }
        return true;
    }
/**
 * function :sortCategory
 * description: list category with time buy
 * author: Danglv FR05
 */
    public function listCategory($info=array(),$allcate=array())
    {
        foreach($allcate as $key=>$value)
        {
            foreach($info as $key_i=>$value_i)
            {
                if($allcate[$key]['category_id']==$info[$key_i]['category_id'])
                {
                    $allcate[$key]['timebuy'] = $info[$key_i]['timebuy'];
                }
                else
                {
                    $allcate[$key]['timebuy']=0;
                }
            }
        }
        return $allcate;
    }
/**
 * function :getDate
 * description: get and convert date from form or ajax
 * author: Danglv FR05
 */
    public function getDate(){
        $data['datestart'] =  $_POST['datestart'];
        $data['dateend'] = $_POST['dateend'];
       // $data['datestart'] = ;
        unset($m);
        if($data['datestart'])
        {
            preg_match( "/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/", $data['datestart'], $m );
            $data['datestart'] = mktime( 0, 0, 0, $m[1], $m[2], $m[3] );
        }
        else{
            $data['datestart']=0;
        }
        unset($m);
        if($data['dateend'])
        {
            preg_match( "/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/", $data['dateend'], $m );
            $data['dateend'] = mktime( 23, 59, 59, $m[1], $m[2], $m[3] );
        }
        else{
            $data['dateend']=0;
        }
        return $data;
    }
}
