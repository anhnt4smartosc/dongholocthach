<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 8/11/14
 * Time: 11:47 AM
 */

class products extends BaseAdminController {

    CONST LIMIT = 9;
    CONST IMAGE_UPLOAD_DIR = "public/products/images/";

    private $resolution = array(
        'thumb_slide' => array(
            'width'=>300,
            'height'=>200),
        'thumb_list' => array(
            'width'=>230,
            'height'=>172),
    );
    public function __construct(){
        parent::__construct();
        $this->load->model("products_model");
        $this->load->model("brand_model");
        $this->load->library("pagination");
        $this->load->library('image_lib');
        $this->_supported_extensions = array('jpg', 'jpeg', 'gif', 'png', 'pdf');
    }

    public function test() {
        $tempInfo = array(
            'page_title' => "Test",
            'template' => 'products/testFile',
            'listFile' => $this->getFileList(self::IMAGE_UPLOAD_DIR)
        );
        $this->loadView("template/layout",$tempInfo);
    }

    public function imageThumbnailConfig($image){
        $config['image_library'] = 'gd2';
        $config['source_image']	= self::IMAGE_UPLOAD_DIR."/$image";
        $config['create_thumb'] = TRUE;
        $config['new_image'] = self::IMAGE_UPLOAD_DIR."/230x172";
        $config['maintain_ratio'] = TRUE;
        $config['width']	= $this->resolution['thumb_list']['width'];
        $config['height']	= $this->resolution['thumb_list']['height'];
        $this->image_lib->initialize($config);
        $this->image_lib->resize();


    }
    public function imageSaleConfig($image){
        $config['image_library'] = 'gd2';
        $config['source_image']	= self::IMAGE_UPLOAD_DIR."/$image";
        $config['create_thumb'] = TRUE;
        $config['new_image'] = self::IMAGE_UPLOAD_DIR."/300x200";
        $config['maintain_ratio'] = TRUE;
        $config['width']	= $this->resolution['thumb_slide']['width'];
        $config['height']	= $this->resolution['thumb_slide']['height'];
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

    }

    public function config($total){
        $config['base_url'] = base_url("admin/products/index/page");
        $config['total_rows'] = $total;
        $config['per_page'] = self::LIMIT;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 5;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_closed'] = '</ul>';
        $config['prev_tag_open'] = $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['cur_tag_open'] = "<li><a class='cur_page'>";
        $config['prev_tag_close'] = $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_close'] = "</a></li>";
        $config['next_link'] = 'Next →';
        $config['prev_link'] = '← Previous';
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $config['last_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $this->pagination->initialize($config);
    }


    public function sale(){
        $tempInfo = array(
            'page_title' => "Các sản phẩm đang sale",
            'template' => 'products/sale',
            'listProducts' => $this->products_model->listSale()
        );
        $this->loadView("template/layout",$tempInfo);
    }

    public function index(){
        $page = $this->uri->segment(5)?$this->uri->segment(5):1;
        $product_name = "";
        $brand_id = -1;
        if($this->input->get("btnOk")){
            $product_name = $this->input->get("product_name");
            $brand_id = $this->input->get("brand_id");
        }
        $tempInfo = array(
            'page_title' => 'Danh sách sản phẩm',
            'template' => 'products/list',
            'listBrands' => $this->brand_model->listBrand(),
            'product_name'=> $product_name,
            'brand_id' => $brand_id
        );
        $tempInfo['listProducts'] = $this->products_model->listProducts("","",$product_name,$brand_id);
        $total = $this->products_model->listProductsNumRows("","",$product_name,$brand_id);
        $this->config($total);
        $tempInfo['listProducts'] = $this->products_model->listProducts(self::LIMIT,($page-1)*self::LIMIT, $product_name,$brand_id);
        $tempInfo['pager'] = $this->pagination->create_links();
        $this->loadView("template/layout",$tempInfo);
    }

    public function insert(){
        if($this->input->post("btnOk")){
            $saleStart = new DateTime($this->input->post("product_sale_date_start"));
            $saleEnd = new DateTime($this->input->post("product_sale_date_end"));
            $product = array(
                'product_name' => $this->input->post("product_name"),
                'product_description' => $this->input->post("product_description"),
                'product_price' => $this->input->post("product_price"),
                'product_sale' => $this->input->post("product_sale"),
                'product_create_date' => date("Y-m-d H:i:s"),
                'product_sale_date_start' =>$saleStart->format("Y-m-d H:i:s"),
                'product_sale_date_end' =>$saleEnd->format("Y-m-d H:i:s"),
                'brand_id' => $this->input->post("brand_id"),

            );
            $product['product_main_image'] = $this->uploadMainImage();
            $this->products_model->insertProduct($product);

            redirect(base_url("admin/products/index"));
        }
        $tempInfo = array(
            'page_title' => 'Thêm mới sản phẩm',
            'template' => 'products/add',
            'listBrands' => $this->brand_model->listBrand(),
            'ckeditor' => $this->_setup_ckeditor('product_description'),
            'content_html' => '',
        );
        $this->loadView("template/layout",$tempInfo);
    }

    public function deleteImage(){
        $image_path = "public/products/images/".$this->uri->segment(4);
        unlink($image_path);
    }

    public function update(){
        $product_id = $this->uri->segment(4);
        $productUpdating = $this->products_model->getProduct($product_id);
        $saleStart = new DateTime($this->input->post("product_sale_date_start"));
        $saleEnd = new DateTime($this->input->post("product_sale_date_end"));
        if($this->input->post("btnOk")){
            $product = array(
                'product_name' => $this->input->post("product_name"),
                'product_description' => $this->input->post("product_description"),
                'product_price' => $this->input->post("product_price"),
                'product_sale' => $this->input->post("product_sale"),
//                'product_create_date' => date("Y-m-d H:i:s"),
                'product_sale_date_start' =>$saleStart->format("Y-m-d H:i:s"),
                'product_sale_date_end' =>$saleEnd->format("Y-m-d H:i:s"),
                'brand_id' => $this->input->post("brand_id"),
            );
            if($_FILES['product_main_image']['name']){
                $product['product_main_image'] = $this->uploadMainImage();
            }
            $this->products_model->updateProduct($product_id,$product);
            redirect(base_url("admin/products/index"));
        }
        $tempInfo = array(
            'page_title' => 'Thêm mới sản phẩm',
            'template' => 'products/update',
            'listBrands' => $this->brand_model->listBrand(),
            'product' => $productUpdating,
            'ckeditor' => $this->_setup_ckeditor('product_description'),
            'content_html' => $productUpdating['product_description']
        );
        $this->loadView("template/layout",$tempInfo);
    }

    public function delete(){
        $product_id = $this->uri->segment(4);
        $this->products_model->deleteProduct($product_id);
        redirect(base_url("admin/products/index"));
    }

    function getFileList($dir)
    {
        // array to hold return value
        $retval = array();

        // add trailing slash if missing
        if(substr($dir, -1) != "/") $dir .= "/";

        // open pointer to directory and read list of files
        $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
        while(false !== ($entry = $d->read())) {
            // skip hidden files
            if($entry[0] == ".") continue;
            if(is_dir("$dir$entry")) {
                $retval[] = array(
                    "name" => "$dir$entry/",
                    "type" => filetype("$dir$entry"),
                    "size" => 0,
                    "lastmod" => filemtime("$dir$entry")
                );
            } elseif(is_readable("$dir$entry")) {
                $retval[] = array(
                    "name" => "$dir$entry",
//                    "type" => mime_content_type("$dir$entry"),
                    "size" => filesize("$dir$entry"),
                    "lastmod" => filemtime("$dir$entry")
                );
            }
        }
        $d->close();

        return $retval;
    }

    private function uploadMainImage() {
        $fileName = $_FILES['product_main_image']['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $config['upload_path'] = 'public/products/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '2048';
        $config['max_width'] = '3000';
        $config['max_height'] = '2000';
        $config['file_name']= $fileName = time().".$ext";
        $config['overwrite'] = false;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('product_main_image');
        $this->imageThumbnailConfig($fileName);

        $this->imageSaleConfig($fileName);

        return $fileName;
    }
    private function uploadMultilImages() {
        $fileInfo = $_FILES['imgs'];
        $fileName = array();
        if (isset($fileInfo['name']) && $fileInfo['name'] != null) {
            for ($i = 0; $i < count($fileInfo['name']); $i++) {
                $nameFile = time() . $fileInfo['name'][$i];
                $fileName[] = $nameFile;
                move_uploaded_file($fileInfo['tmp_name'][$i], "public/products/images/" . $nameFile);
            }
        }
        return $fileName;
    }


    public function upload()
    {
        $callback = 'null';
        $url = '';
        $get = array();

        // for form action, pull CKEditorFuncNum from GET string. e.g., 4 from
        // /form/upload?CKEditor=content&CKEditorFuncNum=4&langCode=en
        // Convert GET parameters to PHP variables
        $qry = $_SERVER['REQUEST_URI'];
        parse_str(substr($qry, strpos($qry, '?') + 1), $get);

        if (!isset($_POST) || !isset($get['CKEditorFuncNum'])) {
            $msg = 'CKEditor instance not defined. Cannot upload image.';
        } else {
            $callback = $get['CKEditorFuncNum'];

            try {
                $url = $this->_move_image($_FILES['upload']);
                $msg = "File uploaded successfully to: {$url}";

                // Persist additions to file manager CMS here.

            } catch (Exception $e) {
                $url = '';
                $msg = $e->getMessage();
            }
        }

        // Callback function that will insert image into the correct CKEditor instance
        $output = '<html><body><script type="text/javascript">' .
            'window.parent.CKEDITOR.tools.callFunction(' .
            $callback .
            ', "' .
            $url .
            '", "' .
            $msg .
            '");</script></body></html>';

        echo $output;
    }

    /**
     * Move uploaded file to the storage directory only if its MIME type is
     * accepted.
     *
     * @param $temp_location $_FILES array entry w/ details of local file.
     * @throws Exception When there are issues moving file to upload directory.
     */
    private function _move_image($temp_location)
    {
        $filename = basename($temp_location['name']);
        $info = pathinfo($filename);
        $ext = strtolower($info['extension']);

        if (isset($temp_location['tmp_name']) &&
            isset($info['extension']) &&
            in_array($ext, $this->_supported_extensions)) {
            $new_file_path = self::IMAGE_UPLOAD_DIR . DIRECTORY_SEPARATOR  . $filename;
            if (!is_dir(self::IMAGE_UPLOAD_DIR) ||
                !is_writable(self::IMAGE_UPLOAD_DIR)) {
                // Attempt to auto-create upload directory.
                if (!is_writable(self::IMAGE_UPLOAD_DIR) ||
                    FALSE === @mkdir(self::IMAGE_UPLOAD_DIR, null , TRUE)) {
                    throw new Exception('Error: File permission issue, ' .
                        'please consult your system administrator');
                }
            }

            if (move_uploaded_file($temp_location['tmp_name'], $new_file_path)) {
                return base_url() . DIRECTORY_SEPARATOR . $new_file_path;
            }
        }

        throw new Exception('File could not be uploaded.');
    }

    /**
     * Retrieve configuration properties for CKEditor instance. Ensure the
     * CodeIgniter helper has been copied to CI's system directory.
     *
     * @param $id HTML id="" attribute CKEditor instance is enabled for.
     *
     * @return array First parameter for display_ckeditor() function invoked
     *         in the CI view.
     */
    private function _setup_ckeditor($id)
    {
        $this->load->helper('url');
        $this->load->helper('ckeditor');

        $ckeditor = array(
            'id' => $id,
            'path' => 'public/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '1000px',
                'height' => '400px',
                'filebrowserImageUploadUrl' => base_url("admin/products/upload"),
                'filebrowserBrowseUrl' => base_url("public/products/images")
            )
        );

        return $ckeditor;
    }
} 