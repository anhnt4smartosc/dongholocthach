<?php
class user extends BaseAdminController
{
    protected $_error;
    public function  __construct(){
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library("form_validation");
        $this->load->library("encrypt");
        $this->load->library("pages");
        $this->load->library('session');

    }
    public function insert() {
        if($this->input->post("ok")){
            $this->form_validation->set_rules("user_name","Tên thành viên","trim|required");
            $this->form_validation->set_rules("user_password","Mật khẩu ","trim|required|matches[user_password_conf]");
            $this->form_validation->set_rules('user_password_conf', 'Xác nhận mật khẩu', 'trim|required');
            $this->form_validation->set_rules("user_fullName","Tên đầy đủ","trim|required");
            $this->form_validation->set_rules("user_email","Email","trim|required|valid_email");
            $this->form_validation->set_rules("user_address","Địa chỉ ","trim|required");
            $this->form_validation->set_rules("user_phone","Số điện thoại","trim|required|numeric");
            $this->form_validation->set_rules("user_gender","Giới tính","required");
            $this->form_validation->set_rules("user_level","Vai trò","required");

            $this->form_validation->set_message("required","%s không thể rỗng");
            $this->form_validation->set_message("min_length","%s không được nhỏ hơn %d ký tự");
            $this->form_validation->set_message("matches","%s không chính xác");
            $this->form_validation->set_message("valid_email","%s không đúng định dạng mail");
            $this->form_validation->set_message("numeric","%s phải bao gồm các số");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
        if($this->form_validation->run()){
            $encrypted_password = md5($this->input->post("user_password"));
            $dataUser = array(
                "user_name"=>$this->input->post("user_name"),
                "user_password"=>$encrypted_password,
                "user_fullName"=>$this->input->post("user_fullName"),
                "user_email"=>$this->input->post("user_email"),
                "user_address"=>$this->input->post("address"),
                "user_phone"=>$this->input->post("user_phone"),
                "user_gender"=>$this->input->post("user_gender"),
                "user_level"=>$this->input->post("user_level")
            );
            $this->user_model->insertUser($dataUser);
            redirect(base_url("admin/user/index"));
            //return;
        }

        }
        $data = array();
        $data['page_title'] = "Thêm mới người dùng";
        $data['template'] = "user/insert";
        $this->loadView("template/layout",$data);
    }

    public function delete(){
        $id = $this->uri->segment(4);
        if ($id == '' || $id == null) echo "error";
        $this->user_model->deleteUser($id);
        redirect(base_url("admin/user/index"));
    }

    public function index()
    {
        $this->listuser();
    }

    public function login(){
        //$query = $this->_error;
        $query = array();
        if(isset($_POST['username'])&& $_POST['username'] !=null &&isset($_POST['password'])&& $_POST['password'] !=null) {
            $userInfo = $_POST;
            $password = $userInfo['password'];
            $username = $userInfo['username'];
            if($this->check_data(($userInfo)) == false){
                $query['error'] = $this->_error;
                $query['username'] = $username;
                $query['password'] = $password;
            }else{
//                $encryptPassword = md5($password);
                $encryptPassword = $password;
                $query['result'] = $this->user_model->login($username, $encryptPassword);
                if($query['result'] == ""){
                    $query['error'] = "Tên đăng nhập và mật khẩu không đúng";
                    $this->loadView("template/login",$query);
                    return;
                }else{
                    $this->session->set_userdata("user",$query['result'][0]);
                    $this->listuser();
                    return;
                }
            }
        }
        $this->loadView("template/login",$query);
    }

    public function logout(){
        if($this->session->userdata['user']){
            $this->session->unset_userdata('user');
            redirect(base_url("admin/user/login"));
        }
    }


    //DangLV
    public function listuser($info=array())
    {
        if(!empty($info))
        {
            $info['page_title'] = "Danh sách người dùng";
            $info['template'] = "user/listuser";
            $this->loadView("template/layout",$info);
        }
        else
        {
            if(isset($_GET['sortby'])&&$_GET['sortby']!=""&&isset($_GET['typesort'])&&$_GET['typesort']!="")
            {
                $data['sortby'] = isset($_GET['sortby'])?$_GET['sortby']:"";
                $data['typesort'] =isset($_GET['typesort'])?$_GET['typesort']:"";
                $data['listuser'] = $this->user_model->sortUser($_GET['sortby'],$_GET['typesort'],"","");
            }
            else{
                $data['sortby']="";
                $data['typesort']="";

                $data['listuser'] = $this->user_model->listUser();
            }
            $data['limit'] =5;
            $total = count($data['listuser']);
            $page = isset($_POST['page'])?$_POST['page']:1;
            $data['numpage'] = ceil($total/$data['limit']);
            $data['start']=($page-1)*$data['limit'];
            $url = base_url();
            //$data['currentpage'] = $this->uri->segment(4);
            $data['pages'] = $this->pages->pageList($data['numpage'],$data['sortby'],$data['typesort'],$url);
            $this->pageUser($data);
        }

    }
    public function pageUser($data=array())
    {
        $data['listuser'] = $this->user_model->sortUser($data['sortby'],$data['typesort'],$data['limit'],$data['start']);
        $this->listuser($data);
    }
    public function ajaxUser()
    {
        $page = isset($_POST['page']);
        $data['limit'] =5;
        $page = isset($_POST['page'])?$_POST['page']:1;
        $data['start']=($page-1)*$data['limit'];
        if(isset($_POST['sortby'])&&$_POST['sortby']!=""&&isset($_POST['typesort'])&&$_POST['typesort']!="")
        {
            $data['sortby'] = isset($_GET['sortby'])?$_GET['sortby']:"";
            $data['typesort'] =isset($_GET['typesort'])?$_GET['typesort']:"";
            $data = $this->user_model->sortUser($_POST['sortby'],$_POST['typesort'], $data['limit'],$data['start']);
        }
        else{
            $data['sortby']="";
            $data['typesort']="";
            $data = $this->user_model->getUserLimit($data['limit'],$data['start']);
        }
        echo json_encode($data);
    }

    public function update()
    {
        $id = $this->uri->segment(4);
        $user = $this->user_model->get_user($id);
        if (isset($_POST['btnok']))
        {
            $params = $_POST;
            if ($this->check_data($params))
            {
                $user["user_fullName"]= $params['txtfullName'];
                $user["user_email"] = $params['txtemail'];
                $user["user_address"] = $params['txtaddress'];
                $user["user_phone"] = $params['txtphone'];
                $user["user_gender"] = $params['txtgender'];

                $this->user_model->update_user($id, $user);
                redirect(base_url("admin/user/index"));
                return;

            }
        }
        $data['user'] = $user;
        $data['error'] = $this->_error;
        $data['template'] = "user/user_update";
        $data['page_title'] = "Chỉnh sửa người dùng";
        $this->loadView("template/layout", $data);
    }
    private function check_data($params)
    {
        $flag = true;
        if($params['username'] == "Username" || $params['username'] == ""){
            $this->_error = "Vui lòng nhập tên đăng nhập";
            $flag = false;
        }
        if($params['password'] == "Password" || $params['password'] == ""){
            $this->_error = "Vui lòng nhập mật khẩu";
            $flag = false;
        }
//        if(($params['username'] == "Username" || $params['username'] == "") && ($params['password'] == "Password" || $params['password'] == "" )){
//            $this->_error = "Vui lòng nhập tên đăng nhập và mật khẩu";
//            $flag = false;
////        }
        return $flag;
    }
}