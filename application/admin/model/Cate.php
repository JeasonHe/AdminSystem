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
       foreach ($arr as $id) {
         db('cate')->where('id',$id)->delete();
       }
      
      return $arr;
    }

   //$id: 删除的Id传给函数
   // $$data:  要删除id开始，往后的数据集合
   // 将当前id与之后数据的pid相比较，如果相同则是该栏目的子栏目，将id存入数组，然后依次递归获取所有的子分类进行删除
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
