<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/21/14
 * Time: 3:26 PM
 */

class product extends BaseAdminController
{
    protected $_temp = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->library("pages");
        $this->load->model("product_model");
        $this->load->model("slider_model");
        $this->load->library("form_validation");
        $this->load->helper(array('form','url'));
        $this->load->model('image_model');
        $this->load->model('product_model');
        $this->load->model('brand_model');
        $this->load->model('category_model');
        $this->load->model('upload');
    }

    public function delete()
    {
        $id = $this->uri->segment(4);
        $this->product_model->deleteProduct($id);

        redirect(base_url("admin/product/index"));
    }


    public function index()
    {
        $this->listProduct();
    }
    public function listProduct($info = array())
    {

        if (!empty($info)) {
            foreach($info['listproduct'] as $key=>$product_i)
            {
                $info['listproduct'][$key]['product_date'] = date("d-M-Y",$info['listproduct'][$key]['product_date']);
                $info['listproduct'][$key]['image_path']=$this->image_model->get_full_path($info['listproduct'][$key]['image_id']);
            }

            $info['page_title'] = "Danh sách sản phẩm";
            $info['template'] = "product/listproduct";
            $this->loadView("template/layout", $info);
        } else {
            if (isset($_GET['searchName']) && $_GET['searchName'] != "") {
                $data['searchName'] = isset($_GET['searchName']) ? $_GET['searchName'] : "";
                $data['listproduct'] = $this->product_model->searchProduct($_GET['searchName']);
            } else {
                $data['searchName'] = "";
                $data['listproduct'] = $this->product_model->searchProduct($data['searchName']);
            }
            $data['limit'] = 6;
            $total = count($data['listproduct']);
            $page = isset($_POST['page']) ? $_POST['page'] : 1;
            $data['numpage'] = ceil($total / $data['limit']);
            $data['start'] = ($page - 1) * $data['limit'];
            $url = base_url();
            //$data['currentpage'] = $this->uri->segment(4);
            $data['pages'] = $this->pages->pageSearchProduct($data['numpage'], $data['searchName'],$url);
            $this->pageProduct($data);
        }

    }
    public function pageProduct($data = array())
    {
        $data['listproduct'] = $this->product_model->searchProduct($data['searchName'],$data['limit'], $data['start']);
        $this->listProduct($data);
    }
    public function ajaxSearchProduct()
    {
        $page = isset($_POST['page']);
        $data['limit'] = 6;
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $data['start'] = ($page - 1) * $data['limit'];
        if (isset($_POST['searchName']) && $_POST['searchName'] != "") {
            $data['searchName'] = isset($_POST['searchName']) ? $_POST['searchName'] : "";
            $data = $this->product_model->searchProduct($data['searchName'], $data['limit'],
                $data['start']);
        } else {
            $data['searchName'] = "";
            $data = $this->product_model->searchProduct($data['searchName'], $data['limit'],
                $data['start']);
        }
        foreach($data as $key=>$value)
        {
            $data[$key]['product_date'] = date("d-M-Y",$data[$key]['product_date']);
            $data[$key]['image_path'] = $this->image_model->get_full_path($data[$key]['image_id']);
        }
        echo json_encode($data);
    }
    public function insert()
    {
        $data['listBrand'] = $this->product_model->get_brand_list();
        $data['listCategory'] = $this->product_model->get_category_list();
        $data['checkedCate'] = $this->input->post("cate_id");

        if ($this->input->post("btninsert")) {
            $cate = $this->input->post("cate_id");
            $this->form_validation->set_rules("product_name", "Tên product", "trim|required");
            $this->form_validation->set_rules("product_desc", "Product description", "trim");
            $this->form_validation->set_rules("product_price", "Product price",
                "trim|required|numeric");
            $this->form_validation->set_rules("product_sale", "Product sale", "trim|numeric");
            $this->form_validation->set_rules("brand_id", "Brand", "trim|required|numeric");
            $this->form_validation->set_rules("cate_id[]", "Category", "required");
            $this->form_validation->set_rules("brand_id", "Brand", "required");
            //$this->form_validation->set_rules("images", "Ảnh chính", "trim|required");

            $this->form_validation->set_message("required", "%s không được rỗng");
            $this->form_validation->set_message("numeric", "%s phải là số");
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
            if ($this->form_validation->run()) {

                $dataProduct = array(
                    "product_name" => $this->input->post("product_name"),
                    "product_date" => time(),
                    "product_desc" => $this->input->post("product_desc"),
                    "product_price" => $this->input->post("product_price"),
                    "product_sale" => $this->input->post("product_sale"),
                    "brand_id" => $this->input->post("brand_id"));

                $pro_id = $this->product_model->insert($dataProduct);

                foreach ($cate as $key => $value) {
                    $array = array('product_id' => $pro_id, 'category_id' => $value);
                    $this->product_model->insert_procate($array);
                }

                $image_path = $this->uploadMainImage();
                $array = array('image_path' => $image_path, 'product_id' => $pro_id);
                $main_imageId = $this->product_model->insert_image($array);
                $this->product_model->update_mainImage($pro_id, $main_imageId);

                $image_path = $this->uploadMultilImages();
                foreach ($image_path as $key => $value) {
                    $array = array('image_path' => $value, 'product_id' => $pro_id);
                    $this->product_model->insert_image($array);
                }
                redirect(base_url("admin/product/index"));
            }

        }

        $data['page_title'] = "Thêm Product";
        $data['template'] = "product/product_insert";

        $this->loadView("template/layout", $data);
    }

    public function build_cate_list($sourceArr,$parents = 0,$arrayValue = array())
    {
        if(count($sourceArr)> 0) {
            echo "<ul>";
            foreach($sourceArr as $key => $value){
                if($value['category_parentId'] == $parents){
                    echo "<ul>";
                    echo "<li><input type ='checkbox' name ='cate_id[]' value ='".$value['category_id']."'>".$value['category_name']."</li>";
                    $newParents = $value['category_id'];
                    unset($sourceArr[$key]);
                    $this->build_cate_list($sourceArr,$newParents,$arrayValue);
                    echo "</ul>";
                }
                echo "</li>";
            }
        }
        echo "</ul>";
    }

    private function uploadMainImage()
    {
        $fileName = "";
        $fileInfo = $_FILES['images'];
        if ($fileInfo['name'] != null) {
            $fileName = time() . $fileInfo['name'];
            move_uploaded_file($fileInfo['tmp_name'], "public/admin/images/" . $fileName);
        }
        return $fileName;
    }
    private function uploadMultilImages()
    {
        $fileInfo = $_FILES['imgs'];
        $fileName = array();
        if (isset($fileInfo['name']) && $fileInfo['name'] != null) {
            for ($i = 0; $i < count($fileInfo['name']); $i++) {
                $nameFile = time() . $fileInfo['name'][$i];
                $fileName[] = $nameFile;
                move_uploaded_file($fileInfo['tmp_name'][$i], "public/admin/images/" . $nameFile);
            }
        }
        return $fileName;
    }
    
    public function chooseSlider()
    {
        $data['listproduct'] = $this->product_model->listTest();
        if(isset($_POST['save'])){
            $isSlider = array();
            $test['listproduct'] = $this->product_model->listTest();
            $listId = array();
            foreach($test['listproduct'] as $product){
                $listId[] = $product['product_id'];
            }

            if($_POST['listSlider']){

                $isSlider['isSlider'] = 1;
                $listIdChecked = array_keys($_POST['listSlider']);
                $temp = array();

                foreach($listIdChecked as $value){
                    $this->product_model->updateProductSlider($value,$isSlider);
                    
                    if($this->slider_model->getslider($value)){
                        $temp['slider_position'] = $value;
                        $temp['product_id'] = $value;
                        $this->slider_model->updateslider("product_id",$value,$temp);
                    }else{
                        $temp['slider_position'] = $value;
                        $temp['product_id'] = $value;
                        $this->slider_model->insertslider($temp);
                    }

                }
                $listIdUnChecked = array_diff($listId,$listIdChecked);
                if($listIdUnChecked){
                    $isSlider['isSlider'] = 0;
                    foreach($listIdUnChecked as $value){
                        $this->product_model->updateProductSlider($value,$isSlider);
                        if($this->slider_model->getslider($value)){
                            $this->slider_model->deleteSlider($value);
                        }
                    }
                }
            }else{
                $isSlider['isSlider'] = 0;
                foreach($listId as $value){
                    $this->product_model->updateProductSlider($value,$isSlider);
                }
                $this->slider_model->delete();
            }
            redirect("/admin/product/chooseSlider");

        }

        $data['page_title'] = "Lựa chọn slider";
        $data['template'] = "product/chooseSlider";
        $this->loadView("template/layout", $data);
    }

    public function moveSlider()
    {
        $data['listslider'] = $this->slider_model->listslider();
        $data['listproduct'] = $this->product_model->listTest();
        $data['page_title'] = "Di chuyển slider";
        $data['template'] = "product/moveSlider";
        if(isset($_POST['save'])){
            $data['position'] =  $_POST['jsonPosition'];
            $data['position'] = json_decode($data['position'], true);
            foreach($data['position'] as $key=>$value){
                $this->_temp['slider_position'] = $key;
                $this->slider_model->updateslider("product_id",$value['id'],$this->_temp);
            }
            redirect("/admin/product/moveSlider");
        }
        $this->loadView("template/layout", $data);
    }


    public function edit($id='')
    {
        if (! $id) {
            $id = $this->uri->segment(4);
        }
        $this->load->model('upload');
        $data = array();
        $data['success'] = FALSE;
        $data['errors'] = array();
        if (isset($_POST['btnok']) )
        {
            //get information
            $brand_id = explode('_', $_POST['brands']);
            $brand_id = end($brand_id);
            $product_name = $this->input->post('product_name');
            $product_price = $this->input->post('product_price');
            $product_sale = $this->input->post('product_sale');
            $procuct_desc = $this->input->post('product_desc');
            $categories = $this->input->post('cate_id');
            $edit_image = $this->input->post('image_edit');
            $upload = $this->input->post('upload');
            $upload_images = isset($_FILES["upload_images"]);
            if ($this->product_form_validation() !== FALSE) {
                //get image upload
                $main_imageid = '';
                $up_image = '';
                if ($edit_image !== false)
                {
                    // get file image up_load || choose file
                    $product_images = $this->input->post('product_images');
                    if ($product_images !== '')
                    {
                        $main_imageid = $product_images;
                    }else if (isset($upload) && $upload !== null && $upload['error'] !== 0)
                    {
                        $ups = $this->upload->do_upload('upload','/product/' . $id);
                        if($ups['error'] != '') {
                            $error = 'Lỗi sinh ra trong quá trình upload';
                            $data['errors'][] = $ups['error']. ', ' . $error;
                        }else {
                            $imgs = array();
                            $imgs['image_path'] = $ups['result']['upload_data']['raw_name']  . $ups['result']['upload_data']['file_ext'] ;
                            $imgs['product_id'] = $id;
                            $imgs['image_name'] = $ups['result']['upload_data']['orig_name'];
                            $temp_id = $this->image_model->insert($imgs);
                            $up_image = isset($up_image) && $up_image !== '' && $up_image != null ?$up_image:$temp_id;
                        }
                    }
                }
                if (isset($_FILES['upload_images']) && !empty($_FILES['upload_images']) && !empty($_FILES['upload_images']['name'][0]))
                {
                    // echo '';
                    //var_dump($_FILES);
                    $this->load->model('upload');
                    $upload = new upload;
                    $up_imgs = $upload->do_upload_multiple("upload_images", '/product/' . $id);
                    /* @var $up_imgs['error'] type error when upload */
                    if($up_imgs['error'] !== '') {
                        $error = 'Up load bi loi';
                        $data['errors'][] =  $error;
                    }else {
                        $i = 0;
                        $error = '';
                        /* @var $up_imgs array upload images */
                        foreach($up_imgs['result'] as $up_img) {
                            if($up_img['error'] !== ''){
                                $error .= 'file thu ' . $i . 'bi loi';
                                $data['errors'][] = $up_img['error'] .', '. $error;
                            }else {
                                $imgs = array();
                                $imgs['image_path'] = $up_img['result']['upload_data']['raw_name']  . $up_img['result']['upload_data']['file_ext'] ;
                                $imgs['product_id'] = $id;
                                $imgs['image_name'] = $up_img['result']['upload_data']['orig_name'];
                                $this->image_model->insert($imgs);
                            }
                            $i ++;
                        }
                    }
                }

                if (empty($data['errors'])) {
                    // get cat id
                    $cats = array();
                    if (isset($categories) && $categories != '')
                    {
                        foreach($categories as $c)
                        {
                            $cats[] = end(explode('_',$c));
                        }
                    }
                    //make data
                    $data = array();
                    $data['brand_id'] = $brand_id;
                    $data['product_name'] = $product_name;
                    $data['product_price'] = $product_price;
                    $data['product_sale'] = $product_sale;
                    $data['product_desc'] = $procuct_desc;

                    $success = false;
                    // update
                    if ( $main_imageid !== '') {
                        $this->product_model->update_product($id, $data, $cats, $main_imageid);
                    }else if ( $up_image !== ''){
                        $this->product_model->update_product($id, $data, $cats, '', $up_image );
                    }else if(!empty($cats)){
                        $this->product_model->update_product($id, $data, $cats);
                    }else {
                        $this->product_model->update_product($id, $data);
                    }
                    $data['success'] = TRUE;
                }
            } else  {
                $data['errors'][] = validation_errors();
            }
        }
        $product = $this->product_model->get_product($id);
        if ($product != null) {
            $brand_id = $product['brand_id'];
            $brand = $this->brand_model->get_brand($brand_id);
            $image_id = $product['product_mainImageId'];
            $image = $this->image_model->get_image($image_id);
            $path = $this->image_model->get_full_path($image_id);
            $categories = $this->product_model->get_category($id);
        } else {
            echo "Error: product_id not yet in list, please wait and system update everything.";
            redirect(base_url());
        }
        if (isset($product) && $product != null) {
            $data['product'] = $product;
            if(isset($image_id) && $image_id && $image_id != "N/A" )$where ="image_id !=$image_id";
            if (!isset($image)) {
                $image =  $this->image_model->get();
                $image_product = $this->image_model->get_image_product($id);
            }else {
                $image_product = $this->image_model->get_image_product($id);
            }
            // make data to view
            $data['image'] = $image;
            $data['image_product'] = $image_product;
            if (!isset($brand)) $brand = $this->brand_model->get();
            $data['brand'] = $brand;
            $data['path'] = $path;
            if (isset($categories) && $categories != 0) {
                $data['categories'] = $categories;
            }
        }

        $data['page_title'] = $data['success'] ? "Thay đổi thành công":"Update product";
        $data['page_title'] = isset($data['errors']) && $data['errors'] ? "Có một số lỗi xảy ra":"Update product";
        $data['template'] = "product/update";

        $this->loadView("template/layout", $data);

    }
    public function remove_image($id)
    {
        $this->image_model->remove_img($id) ;
    }
    public function product_form_validation()
    {
        $this->form_validation->set_rules("product_name", "Tên product", "trim|required");
        $this->form_validation->set_rules("product_desc", "Product description", "trim");
        $this->form_validation->set_rules("product_price", "Product price",
            "trim|required|numeric");
        $this->form_validation->set_rules("product_sale", "Product sale", "trim|numeric");

        $this->form_validation->set_rules("cate_id[]", "Category", "required");
        //$this->form_validation->set_rules("brand_id", "Brand", "required");


        $this->form_validation->set_message("required", "%s không được rỗng");
        $this->form_validation->set_message("numeric", "%s phải là số");
        $this->form_validation->set_error_delimiters("<span class='error'>", "</span><br />");
        return $this->form_validation->run();
    }
}
