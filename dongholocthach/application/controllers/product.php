<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class product extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
    }
    public function index()
    {
       echo __METHOD__;
    }
    public function insert()
    {
        echo __METHOD__;   
    }
}