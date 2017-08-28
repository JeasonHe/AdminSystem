<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller
{
   public function _initialize(){
       $this->getConf();
       $this->getCate();
   }

   public function getConf(){
   	   $data=db('conf')->select();
       $arr=array();
       foreach ($data as $k => $v) {
       	  $arr[$v['enname']]=$v['value'];
       }
       $this->assign('confRes',$arr);
   }

    //获取顶级分类下的Id,用于导航栏输出
   public function getCate(){
   	 $cate=db('cate')->where('pid',0)->select();
   	 foreach ($cate as $k => $v) {
          $arr=db('cate')->where('pid',$v['id'])->select();
          $cate[$k]['child']=$arr;
   	 }
   	 $this->assign('cate',$cate);
   }

   //获取当前分类下所有的子分类的ID
   public function getCateChild($id){
    	static $arrId=array();
    	$data=db('cate')->where('pid',$id)->field('id')->select();
    	if(!count($data)){
            $arrId[]=$id;
    	}
    	else{
    		foreach($data as $k=>$v){
              $this->getCateChild($v['id']);
    	   }
    	}
    	return $arrId;
    	//implode(",",$arrId)
    }

    //每页栏目层级关系显示
    public function getParents($id){
       $pos=$this->_getParents($id);
    	$this->assign('pos',$pos);
    }



    public function _getParents($id){
      static $arr=array();
       $data=db('cate')->where('id',$id)->find();
       if(count($data)){
       	$id=$data['pid'];
       	$arr[]=$data;
       	$this->_getParents($id);
       }
       
        return array_reverse($arr);
    }


}
