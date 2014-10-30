<?php defined('BASEPATH') OR exit('No direct script access allowed');
class pages
{
    protected $_total;
    protected $_pages;
    protected $_limit;
    public function setTotal($data=array())
    {
        $this->_total=count($data);
    }
    public function setLimit($limit)
    {
        $this->_limit = $limit;
    }
    public function getPages()
    {
        $this->_pages = ceil($this->_total/$this->_limit);
    }
    public function pageList($page,$sortby,$typesort,$url)
    {
	$sortby = "'".$sortby."'";  
	$typesort = "'".$typesort."'";      
	$sortby = $sortby?$sortby:"";
    $url = "'".$url."'";
	$typesort = $typesort?$typesort:'""';
        $pageList ="<div id='pager'><ul>";
        for($i=1;$i<=$page;$i++)
        {
            $pageList .='<li><input type ="button" value="'.$i.'" onclick ="ajaxListUser('.$i.','.$sortby.','.$typesort.','.$url.')"></li>';
        }
	$pageList .= "</ul></div>";
        return $pageList;
    }
    public function pageSearchProduct($page,$search_name,$url)
       {
           $search_name = "'".$search_name."'";
           $url = "'".$url."'";
           $pageSearchProduct ="<div id='pager'><ul>";
           for($i=1;$i<=$page;$i++)
           {
               $pageSearchProduct .='<li><input type ="button" value="'.$i.'" onclick ="ajaxSearchProduct('.$i.','.$search_name.','.$url.')"></li>';
           }
           $pageSearchProduct .= "</ul></div>";
           return $pageSearchProduct;
       }
       public function pageReportProduct($page,$url,$datestart,$dateend)
       {
           $url = "'".$url."'";
           $pageReportProduct ="<div id='pager'><ul>";
           for($i=1;$i<=$page;$i++)
           {
               $pageReportProduct .='<li><input type ="button" value="'.$i.'" onclick ="ajaxReportProduct('.$i.','.$url.','.$datestart.','.$dateend.')"></li>';
           }
           $pageReportProduct .= "</ul></div>";
           return $pageReportProduct;
       }
       public function pageHomeProduct($page, $url,$id) {
           $url = "'".$url."'";
           $pageHomeProduct = "<div id ='pager'><ul>";
           for($i=1;$i<=$page;$i++)
           {
               $pageHomeProduct .='<li><input type ="button" value="'.$i.'" onclick ="ajaxHomeProduct('.$i.','.$url.','.$id.')"></li>';
           }
           $pageHomeProduct .= "</ul></div>";
           return $pageHomeProduct;
       }
}