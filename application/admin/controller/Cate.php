<?php
namespace app\admin\controller;
use app\admin\model\Cate as cateModel;
use app\admin\model\Article as articleModel;
class Cate extends Common
{
    protected $beforeActionList = [
        // 'first',
        // 'second' =>  ['except'=>'hello'],
        'delsoncate'  =>  ['only'=>'del'],
    ];

    public function lst()
    {
      $cate=new cateModel();
      $datas=$cate->cateTree();

      $this->assign('List',$datas);
        return view();
    }

    public function add()
    {
      if(Request()->isPost()){
        $data=input('post.');

        $result=$this->validate($data,'Article.add');
           if($result !== true){
              $this->error($result);
           }
        if(db('cate')->insert($data)){
          $this->success('新增栏目成功','cate/lst');
        }
        else{
          $this->error('新增栏目失败','cate/add');
        }
      }

      $cate=new cateModel();
      $datas=$cate->cateTree();
      $this->assign('list',$datas);
        return view();
    }

    public function edit()
    {
        if(Request()->isPost()){
          $data=input('post.');

          $result=$this->validate($data,'Article.edit');
           if($result !== true){
              $this->error($result);
           }
          if(db('cate')->where('id',$data['id'])->update($data)){
            $this->success('修改栏目信息成功','cate/lst');
          }
          else{
            $this->error('修改栏目信息失败','cate/lst');
          }
        }
        $id=input('id');
        $list=db('cate')->where('id',$id)->find();
        $cate=new cateModel();
        $datas=$cate->cateTree();
        $this->assign(array('data'=>$list,'list'=>$datas));

       return view();
    }

    public function del($id){
      $cate=new cateModel;
      
      if(cateModel::destroy($id)){
        $this->success('删除栏目成功','cate/lst');
      }
      else{
        $this->error('删除栏目失败','cate/lst');
      }
    }

    public function delsoncate(){
       $id=input('id');
       $cate=new cateModel;
       $article=new articleModel;
       $arr=$cate->del($id);
       $arr[]=$id;
       foreach ($arr as $key=>$val) {
          $article->where('cateid',$val)->delete();
       }
       
    }

   
}
