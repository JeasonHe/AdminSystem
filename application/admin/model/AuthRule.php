<?php
namespace app\admin\model;
use think\Model;
class AuthRule extends Model
{ 
	public function delAll($id){
		$data=$this->where('id'>=$id)->select();
		$arr=$this->getTree($data,$id);
		foreach($arr as $k=>$v){
			$this->where('id',$v['id'])->delete();
		}
	}
    //获取所有子管理员id
   public function getTree($a,$id=0,$level=0){
    static $arr=array();
   	 foreach($a as $k=>$v){
   	 	if($v['pid']==$id){
        $v['level']=$level;
        $v['dataId']=$this->getId($a,$v['id'],'True');
   	 		$arr[]=$v;
   	 		$this->getTree($a,$v['id'],$level+1);
   	 	}
   	 }
   	 return $arr;
   }

//获取每个权限的所有上级权限Id
   public function getId($a,$id,$clear='false'){
    static $arr=array();
    if($clear=='True'){
      $arr=array();
    }
     foreach($a as $k=>$v){
      if($v['id']==$id){
        $arr[]=$v['id'];
        $this->getId($a,$v['pid'],'true');
      }
     }
     sort($arr);
     $arrString=implode('-',$arr);
     return $arrString;
   }      
}
