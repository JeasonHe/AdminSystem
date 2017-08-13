<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{
    public function cateTree(){
       $data=db('cate')->select();
       return $this->cateSort($data);
    }

    public function cateSort($data,$pid=0,$level=0){
      static $arr=array();
      foreach($data as $key=>$val){
        if($val['pid']==$pid){
          $val['level']=$level;
          $arr[]=$val;
          $this->cateSort($data,$val['id'],$level+1);
        }
      }
      return $arr;
    }

    public function del($id){
      $data=db('cate')->where('id','>','$id')->select();
      $arr=$this->getDelTree($data,$id);
      db('cate')->where('id',$id)->delete();
      foreach ($arr as $id) {
        db('cate')->where('id',$id)->delete();
      }
      return true;
    }

    public function getDelTree($data,$id){
      static $arr =array();
       foreach($data as $key=>$val){
        if($val['pid']==$id){
           $arr[]=$val['id'];
           $data=db('cate')->where('id','>',$val['id'])->select();
           $this->getDelTree($data,$val['id']);
        }
      }
      return $arr;

    }
}
