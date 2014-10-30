<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 8/2/14
 * Time: 9:45 AM
 */

class basic_page extends BaseAdminController{
    const IMAGE_UPLOAD_DIR = "public/admin/images/";
    public function __construct(){
        parent::__construct();
        $this->load->model("basic_page_model");
        $this->load->library("form_validation");
        $this->_supported_extensions = array('jpg', 'jpeg', 'gif', 'png', 'pdf');

    }

    public function index(){
        if($this->input->post("btnOk")){
            $data = $this->input->post("positionArray");
            $data = json_decode($data,true);
            echo "<pre>";
            print_r($data);
            foreach($data as $key => $pos){
                $this->basic_page_model->updatePage($pos['id'],array('basic_page_index' => $key));
            }
            redirect(base_url("admin/basic_page/index"));
        }
        $data = array(
            'template' => 'basic_pages/list',
            'page_title' => 'Danh sách trang',
            'listPages' => $this->basic_page_model->listPages()
        );
        $this->loadView('template/layout',$data);
    }

    public function insert(){
        if($this->input->post("btnOk")){
            $this->form_validation->set_rules('basic_page_name', "Tên trang", "trim|required");
            $this->form_validation->set_rules('basic_page_content', "Nội dung trang", "trim|required");

            $this->form_validation->set_message("required", "%s không được rỗng");

            if($this->form_validation->run()){
                $data = array(
                    'basic_page_name' => $this->input->post("basic_page_name"),
                    'basic_page_content' => $this->input->post("basic_page_content")
                );
                $this->basic_page_model->insert($data);
                redirect(base_url("admin/basic_page/index"));
            }
        }
        $data = array(
            'template' => 'basic_pages/add',
            'page_title' => 'Thêm mới trang',
            'ckeditor' => $this->_setup_ckeditor('txt_content'),
            'content_html' => '' // your model property's HTML for CKEditor textarea
        );
        $this->loadView("template/layout",$data);
    }


    public function update(){
        $id = $this->uri->segment(4);
        $page = $this->basic_page_model->getPage($id);

        if($this->input->post("btnOk")){
            $this->form_validation->set_rules('basic_page_name', "Tên trang", "trim|required");
            $this->form_validation->set_rules('basic_page_content', "Nội dung trang", "trim|required");

            $this->form_validation->set_message("required", "%s không được rỗng");

            if($this->form_validation->run()){
                $data = array(
                    'basic_page_name' => $this->input->post("basic_page_name"),
                    'basic_page_content' => $this->input->post("basic_page_content",true)
                );
                $this->basic_page_model->updatePage($id,$data);
                redirect(base_url("admin/basic_page/index"));
            }
        }

        $data = array(
            'page_title' => 'Chỉnh sửa trang',
            'template' => 'basic_pages/update',
            'page' => $page,
            'ckeditor' => $this->_setup_ckeditor('txt_content'),
            'content_html' => $page['basic_page_content']
//            'content_html' => '' // your model property's HTML for CKEditor textarea

        );
        $this->loadView("template/layout",$data);
    }


    public function delete(){
        $id = $this->uri->segment(4);
        try{
            $this->basic_page_model->deletePage($id);
            redirect(base_url("admin/basic_page/index"));
        }
        catch(Exception $ex){
            echo "Đã có lỗi xảy ra";
        }
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
            'path' => 'public/ckeditor-full',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '1000px',
                'height' => '400px',
                'filebrowserImageUploadUrl' => base_url("admin/basic_pages/upload"),
                'filebrowserBrowseUrl' => base_url("public/admin/images")
            )
        );

        return $ckeditor;
    }
} 