<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{
  //   public static function init(){
  //    Cate::event('before_delete',function($data){
  //        echo $this->getDelTree($data,$data->id);die;
  //    });    
  // } 

    public function cateTree(){
       $data=db('cate')->paginate(10);
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
