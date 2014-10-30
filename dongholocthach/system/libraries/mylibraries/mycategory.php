<?php
class mycategory
{
    protected $_sourceArr;

    public function __construct($sourceArr = null){
        $this->_sourceArr = $sourceArr;
    }
    public function buildArray($colums,$parents = 0)
    {
        $this->recursive($this->_sourceArr,$colums,$parents,1,$resultArr);
        return $resultArr;
    }

    public function buildMenu($colums,$parents = 0)
    {
        $this->createMenu($this->_sourceArr,$colums,$parents,1,$resultArr);
        return $resultArr;
    }
    public function recursive($sourceArr,$column = 'category_parentId',$parents = 0,$level = 1,&$resultArr){
        if(count($sourceArr)> 0){
            foreach($sourceArr as $key => $value){
                if($value['category_parentId'] == $parents){
                    $value['level'] = $level;
                    $resultArr[] = $value;
                    $newParents = $value['category_id'];
                    unset($sourceArr[$key]);
                    $this->recursive($sourceArr,$column,$newParents, $level + 1,$resultArr);
                }
            }
        }
    }
    public function createMenu($sourceArr,$column = 'category_parentId',$parents = 0,$level = 1)
    {
        if(count($sourceArr)> 0) {
            echo "<ul>";
            foreach($sourceArr as $key => $value){
               // echo "<li><a href=''>".$value['category_name']."</a>";
                if($value['category_parentId'] == $parents){
                    echo "<ul>";
                    echo "<li><a href=''>".$value['category_name']."</a></li>";
                    $newParents = $value['category_id'];
                    unset($sourceArr[$key]);
                    $this->createMenu($sourceArr,$column,$newParents, $level + 1);
                    echo "</ul>";
                }
                echo "</li>";
            }
        }
        echo "</ul>";
    }
    public function selectMenu($sourceArr,$column = 'category_parentId',$parents = 0,$level = 1,$befor ="")
    {
        $html ="";
        if(count($sourceArr)>0){
            foreach($sourceArr as $key => $value){
                // echo "<li><a href=''>".$value['category_name']."</a>";
                if($value['category_parentId'] == $parents){
                    $after =$befor."&nbsp&nbsp&nbsp&nbsp&nbsp";
                    $html .= "<option value='".$value['category_id']."'><a href=''>".$befor.$value['category_name']."</a></option>";
                    $newParents = $value['category_id'];
                    unset($sourceArr[$key]);
                    $html.=$this->selectMenu($sourceArr,$column,$newParents, $level + 1,$after);
                }
            }
        }
        return $html;
    }
    public function selectedMenu($sourceArr,$id,$column = 'category_parentId',$parents = 0,$level = 1,$befor ="")
    {
        $html ="";
        if(count($sourceArr)>0){
            foreach($sourceArr as $key => $value){
                if($value['category_parentId'] == $parents){
                    $after =$befor."&nbsp&nbsp&nbsp&nbsp&nbsp";
                    if($value['category_id']==$id)
                    {
                        $selected = "selected='selected'";
                    }
                    else
                    {
                        $selected ="";
                    }
                    $html .= "<option ".$selected." value='".$value['category_id']."'><a href=''>".$befor.$value['category_name']."</a></option>";
                    $newParents = $value['category_id'];
                    unset($sourceArr[$key]);
                    $html.=$this->selectedMenu($sourceArr,$id,$column,$newParents, $level + 1,$after);
                }
            }
        }
        return $html;
    }
    public function build_cate_list($sourceArr,$column = 'category_parentId',$parents = 0,$arrayValue = array())
    {
        if(count($sourceArr)> 0) {
            echo "<ul>";
            foreach($sourceArr as $key => $value){
                if($value['category_parentId'] == $parents){
                    echo "<ul>";
                    echo "<li><input type ='checkbox' name ='cate_id[]' value ='".$value['category_id']."'>".$value['category_name']."</li>";
                    $newParents = $value['category_id'];
                    unset($sourceArr[$key]);
                    $this->build_cate_list($sourceArr,$column,$newParents,$arrayValue);
                    echo "</ul>";
                }
                echo "</li>";
            }
        }
        echo "</ul>";
    }
}