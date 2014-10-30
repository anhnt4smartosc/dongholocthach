<?php
class Config extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('config_model');
    }
    public function index($start = 0)
    {
        $start = $this->uri->segment(4);
        $start = $start && $start != null ? $start : 0;
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $configs = $this->config_model->configs(7,$start);

        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/config/index/';
        $config['total_rows'] = $this->config_model->total_configs();
        $config['per_page'] = 7;
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<div>';
        $config['prev_tag_close'] = '</div>';
        $config['last_link'] = 'Last';
        $this->pagination->initialize($config);
        
        $data['pages'] = $this->pagination->create_links();        
        $data['configs'] = $configs;
        $data['first_link'] = $start;
        //$this->load->view('config/configs',$data);
        $data['template'] = "config/configs";
        $data['page_title'] = "Chỉnh sửa config";

        $this->loadView("template/layout",$data);
        
    }
    public function new_config()
    {
        if (isset($_POST['submit']) || isset($_POST['btnok'])) {
            $data = array(
                'config_name' => '',
                'config_value' => '',
            );
            $data = $this->get_input($data,'post');
            $this->config_model->create_one($data);
            redirect(base_url() .'admin/config/index');
        }else {
            $data['template'] = "config/new_config";
            $data['page_title'] = "Thêm config";

            $this->loadView("template/layout",$data);


            $this->load->view('config/new_config');
        }
    }
    protected function delete($id, $where = '')
    {
        if (isset ($id) && $id != null) {
            $this->config_model->delete($id,$where);
        }
    }
    public function update()
    {
        if (isset($_POST['submit'])) {
            var_dump($_POST);
            $dels = array();
            $edits = array();
            foreach($_POST as $key => $val)
            {
                if(strpos($key, 'del') !== FALSE){
                    $dels[] = end(explode('_', $key));
                }else if(strpos($key, 'edit') !== FALSE) {
                    $edits[] = end(explode('_', $key));
                }
            }
            if (!empty($dels)) {
                foreach($dels as $id) {
                    $this->delete($id);
                }
            }
            if (!empty($edits)) {
                // update value of name
                // update name of variables
                $data = array();
                foreach($edits as $id)
                {
                    $k_value = 'config_value_' . $id; 
                    $data [] = array (
                        'config_id' => $id,
                        'config_value' => $_POST[$k_value]
                    );
                }
                $this->config_model->update('config_id',$data);
            }
        }
        $first_link = $this->input->post('first_link');
        if ($first_link === FALSE) $first_link = '';
        redirect(base_url() . 'admin/config/index/' . $first_link);
    }
    public function get_input($data, $post='post')
    {
        $method = (strtolower($post) == 'post') ? 'post' : 'get';
        $r_data = array();
        foreach($data as $key => $val)
        {
            $r_data[$key] = $this->input->{$method}($key);
        }
        return $r_data;
    }
    public function get_config($id)
    {
        $value = $this->config_model->get_value($id);
        return $value;
    }
}

?>