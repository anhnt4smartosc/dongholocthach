<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/20/14
 * Time: 10:39 PM
 */

class BaseAdminController extends CI_Controller{
    protected $_infos = array();

    public function __construct(){
        parent::__construct();
        $this->load->library("session");

        if(!isset($this->session->userdata['user'])&&$this->uri->segment(3)!="login")
        {
            redirect(base_url("admin/user/login"));
        }
    }

    public function loadView($url,$data = array()){

        if(isset($this->session->userdata['user']) && $this->session->userdata['user']!=null){
            $data['userAu'] = $this->session->userdata['user'];
        }
        $this->load->view($url,$data);
    }

}