<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 8/16/14
 * Time: 2:36 PM
 */

class basic_page extends BasePublicController{
    public function __construct(){
        parent::__construct();
        $this->load->model("basic_page_model");
    }

    public function view(){
        $page_id = $this->uri->segment(4);
        $page = $this->basic_page_model->getPage($page_id);

        $tempInfo = array(
            'page_title' => $page['basic_page_name'],
            'template' => 'basic_page/view',
            'page' => $page
        );

        $this->loadView('template2/layout',$tempInfo);
    }
}
