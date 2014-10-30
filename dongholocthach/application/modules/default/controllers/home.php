<?php
class home extends BasePublicController
{
    public function  __construct()
    {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("products_model");
        $this->load->library("form_validation");

        $this->load->library("pages");
        $this->load->library("cart");
        $this->load->library("pagination");
    }

    public function pagingConfig($total_rows, $brand_id = -1,$base_url = ""){
        $config['total_rows'] = $total_rows;
        $config['base_url']= $base_url ? base_url("default/home/search"):base_url("default/home/brand/$brand_id");
        $config['per_page'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 5;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['prev_tag_open'] = $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['cur_tag_open'] = "<li><a class='cur_page'>";
        $config['prev_tag_close'] = $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_close'] = "</a></li>";
        $config['next_link'] = 'Tiếp theo →';
        $config['prev_link'] = '← Lùi lại';
        $config['first_link'] = 'Đầu tiên';
        $config['last_link'] = 'Cuối cùng';

        $this->pagination->initialize($config);
    }
/**
 * function index : show all product or product with category
 * author: Danglv FR05
 */
    private function getRangeSlider($brand_id) {
        $min_price = $this->products_model->getMinPrice($brand_id);
        $max_price = $this->products_model->getMaxPrice($brand_id);
        $html  = "<div id='rangeval'></div>";
        $html .= "<input type='hidden' name='minprice' id='minprice' value='".$min_price."'>";
        $html .= "<input type='hidden' name='maxprice' id='maxprice' value='".$max_price."'>";
        $html .= "<div id='rangeslider'></div>";
        return $html;
    }

    private function listBrand($list=array()) {
        $listbrand = "<ul>";
        foreach($list as $key=>$value)
        {
            $listbrand .="<li><input type='checkbox' name='checkbrand' class='checkbrand' value='".$value['brand_id']."'><span>".$value['brand_name']."</span></li>";
        }
        $listbrand .="</ul>";
        return $listbrand;
    }

    public function index(){
        $brand_id_1 = 19;
        $brand_id_2 = 20;
        $data = array(
            'list_brand' => $this->listBrand($this->brand_model->listBrand()),
            'page_title' => 'Danh sách sản phẩm',
            'template' => 'products/home',
            'brand_1' => $this->brand_model->getBrand($brand_id_1),
            'brand_2' => $this->brand_model->getBrand($brand_id_2),
            'listHotProducts' => $this->getResizeList( $this->products_model->listProducts(6,0,"",-1,"","",'product_views','desc'), 'thumb' ),
            'listHotBrandProducts_1' => $this->getResizeList($this->products_model->listProducts(3, 0, "",$brand_id_1),'thumb'),
            'listHotBrandProducts_2' => $this->getResizeList($this->products_model->listProducts(3, 0, "",$brand_id_2),'thumb'),
            'listSale' => $this->getResizeList($this->products_model->listSale(),'slide')
        );
        $this->loadView("template2/layout",$data);
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
    public function brand(){
        $brand_id = $this->uri->segment(4);
        $page = $this->uri->segment(5)?$this->uri->segment(5):1;
        $brand = $this->brand_model->getBrand($brand_id);
        $data = array(
            'page_title' => $brand['brand_name'],
            'template' => 'products/list',
            'listProducts' => $this->products_model->listProducts("","","",$brand['brand_id'])
        );

        $this->pagingConfig($this->products_model->listProductsNumRows("","","",$brand['brand_id']), $brand_id);
        $data['pager'] = $this->pagination->create_links();
        $data['brand_id'] = $brand['brand_id'];
        $data['order'] = "product_create_date";
        $data['order_opt'] = "desc";
        $data['listProducts'] = $this->getResizeList($this->products_model->listProducts($this->pagination->per_page, ($page - 1) * $this->pagination->per_page, "",$brand['brand_id']),'thumb');
        if(count($data['listProducts'])>0){
            $data['range_slider'] = $this->getRangeSlider($brand_id);
        }
        $this->loadView("template2/layout",$data);
    }

    public function ajaxBrand(){
        $data['brand_id'] = $brand_id = $this->uri->segment(4);
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $data['order'] = $order = $this->input->post('order');
        $data['order_opt'] = $order_opt = $this->input->post('order_opt');
        $page = $this->uri->segment(5)?$this->uri->segment(5):1;
        $total = $this->products_model->listProductsNumRows("","","",$brand_id,$min_price,$max_price,$order,$order_opt);
        $this->pagingConfig($total,$brand_id);
        $data['pager'] = $this->pagination->create_links();
        $data['listProducts'] = $this->products_model->listProducts($this->pagination->per_page,($page-1) * $this->pagination->per_page,"",$brand_id,$min_price,$max_price,$order,$order_opt);
//        echo json_encode($data);
        echo $this->load->view("products/list",$data);
    }

    public function product(){
        $product_id = $this->uri->segment(4);
        $product = $this->products_model->getProduct($product_id);
        $data['product_views'] = $product['product_views']+1;
        $this->products_model->updateProduct($product_id, $data);
        $data = array(
            'page_title' => $product['product_name'],
            'template' => 'products/detail',
            'product' => $product,
            'brand' => $this->brand_model->getBrand($product['brand_id']),
            'listRelatedProducts'=> $this->getResizeList($this->products_model->listProducts(4, 0, "",$product['brand_id'],"","","product_price"),"thumb")
        );
        $this->loadView("template2/layout",$data);
    }

    public function details()
    {
        $id = $this->uri->segment(4);
        $product = $this->product_model->detailProduct($id);
        $main_image = $this->product_model->get_main_image($product['product_mainImageId']);
        $images = $this->product_model->get_images($product['product_id']);
        $main_image = base_url("public/admin/images/".$main_image['image_path']);
        foreach($images as $key=>$value)
        {
            $images[$key] = base_url("public/admin/images/".$value['image_path']);
        }
        $brand = $this->product_model->get_brand($product['brand_id']);
        $rate_avg = $this->product_model->get_rate_average($product['product_id']);
        $rate_avg = round($rate_avg,1);
        $rate_num = $this->product_model->get_num_rate($product['product_id']);
        $comments = $this->comment_model->get_comments($product['product_id']);

        $data['comments'] = $comments;
        $data['rate_avg'] = $rate_avg;
        $data['rate_num'] = $rate_num;
        $data['brand'] = $brand;
        $data['main_image'] = $main_image;
        $data['images'] = $images;
        $data['product'] = $product;
        $data['page_title'] = "Product";
        $data['template'] = "product/detail";
        $this->loadView("template2/layout", $data);
    }

    public function basic_page(){
        $id = $this->uri->segment(4);
        $this->load->model("basic_page_model");

        $page = $this->basic_page_model->getPage($id);
        $data = array(
            'template' => "basic_page/view",
            'page_title' => $page['basic_page_name'],
            'page' => $page
        );
        $this->loadView("template2/layout",$data);
    }

    public function search(){
        
        $searchName = $this->input->get('searchName');
        
        die($searchName);
        if(!$searchName){
            $this->loadView("template2/layout", array(
                'page_title' => 'Kết quả tìm kiếm',
                'template' => 'products/search',
                'listProducts' => [],
                'listFilterBrands' => $this->brand_model->listBrand()
            ));
            return;
        }
        $minPrice = $this->input->get('minPrice')?$this->input->get('minPrice'):"0";
        $maxPrice = $this->input->get('maxPrice')?$this->input->get('maxPrice'):"10000000";
        $brandId = $this->input->get('brandId')?$this->input->get('brandId'):-1;
        $data = array(
            'page_title' => 'Kết quả tìm kiếm',
            'template' => 'products/search',
            'listProducts' => $this->getResizeList($this->products_model->listProducts("","",$searchName,$brandId,$minPrice,$maxPrice),'thumb'),
            'listFilterBrands' => $this->brand_model->listBrand()
        );
        $this->loadView("template2/layout",$data);
    }
    
    public function ajaxSearch() {
        $searchName = $this->input->get('searchName');
        $page = $this->uri->segment(5)?$this->uri->segment(5):1;
        $data = array(
            'listProducts' => $this->products_model->listProducts("","",$searchName)
        );
        $this->pagingConfig($this->products_model->listProductsNumRows("","",$searchName));
        $data['pager'] = $this->pagination->create_links();
        $data['order'] = "product_create_date";
        $data['order_opt'] = "desc";
        $data['listProducts'] = $this->getResizeList($this->products_model->listProducts($this->pagination->per_page, ($page - 1) * $this->pagination->per_page, $searchName),'thumb');
        $this->loadView("products/search",$data);
    }
}