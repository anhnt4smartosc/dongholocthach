<?php
class Upload extends CI_Model
{
    protected $_uploadURL;
    protected $_uploadDir;    //hard link

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->_uploadURL = base_url();
        $this->_uploadURL .= 'public/admin/images/';
        $this->_uploadDir = realpath(APPPATH . '../public/admin/images/');
    }
    public function reset_path()
    {
        $this->_uploadURL = base_url();
        $this->_uploadURL .= 'public/admin/images/';
        $this->_uploadDir = realpath(APPPATH . '../public/admin/images/');
    }
    public function init_var($data=null)
    {
        $config['upload_path'] = $data['upload'];
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '960';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
    }
    function do_upload($userfile='upload', $dist_dir = '', $init=false)
    {
        $upload = ($dist_dir !== '')?$this->_uploadDir . $dist_dir : $this->_uploadDir;
        if(!is_dir($upload))
        {
            if (!mkdir($upload, 0777, true)) {
                die('check see forder to upload');
            }
        }

        $config['upload_path'] = $upload;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '960';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        $data = array();
        if ( ! $this->upload->do_upload($userfile))
        {
            $error = array('error' => $this->upload->display_errors());
            $data = array();
            $data['status'] = false;
            $data['error'] = $error;
            $data['result'] = '';
            return $data;
        } else
        {
            $ups = array('upload_data' => $this->upload->data());
            $data['status'] = true;
            $data['error'] = '';
            $data['result'] = $ups;
            $this->resize($ups['upload_data']['full_path'],$ups['upload_data']['file_name']);

            return $data;
        }
    }
    public function set_upload_dir($dir_path)
    {
        $dir  = APPPATH . '../';
        $dir = realpath($dir);
        $dir .= $dir_path;
        $dir = realpath($dir);
        if(!is_dir($dir)) {
            if(!mkdir($dir,0777,true)){
                return false;
            }
        }
        $this->_uploadDir = $dir;
        $this->_uploadURL = base_url();
        $this->_uploadURL .= $dir_path;
        return $dir;
    }
    public function resize($path, $file, $width=150, $height=150)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']=$width;
        $config['height']=$height;
        $config['new_image']=$path. '/' . $file;

        $this->load->library('image_lib',$config);
        $this->image_lib->resize();
    }
    public function do_upload_multiple($name, $dir='')
    {
        $data = array();
        $file = isset($_FILES[$name])?$_FILES[$name] : '';
        if ($file === '' || $file === null) {
            $data['error']='input error';
            $data['status']=FALSE;
            $data['result']='';
            return $data;
        }
        if (is_array($file['name'])) {
            $uploads = array();
            $n = count($file['name']);
            for($i = 0; $i < $n; $i ++){
                $m_name = $name .'_'.$i;
                $_FILES[$m_name] = array();
                $uploads[] = $m_name;
                foreach($_FILES[$name] as $key => $value) {
                    $_FILES[$m_name][$key] = $value[$i];
                }
            }
            foreach($uploads as $upload){
                $data['result'][]=$this->do_upload($upload, $dir);
            }
            $data['error']='';
            $data['status']=TRUE;
        }else {
            $data = $this->do_upload($name, $dir);
        }
        return $data;
    }
}

