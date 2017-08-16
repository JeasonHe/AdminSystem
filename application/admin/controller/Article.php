<?php
namespace app\admin\controller;
use app\admin\model\Article as articleModel ;
use app\admin\model\Cate as cateModel;
class Article extends Common
{
    public function lst()
    {
         $data=db('article')->field('a.*,b.cateName')->alias('a')->join('bk_cate b','a.cateid=b.id')->order('a.id desc')->paginate(8);
         
        $this->assign('list',$data);
        return view();
    }

    public function add()
    {
      $cate=new cateModel;
      $art=new articleModel;
     
      if(request()->isPost()){
         $data=input('post.');
         $data['time']=time();
        if($art->save($data)){
          $this->success('文章上传成功','article/lst');
        }
          else{
          $this->error('文章上传失败','article/list');
        }
      }
       $datas=$cate->cateTree();
      $this->assign('list',$datas);
        return view();
    }

    public function edit()
    {
      $art=new articleModel();
      $cate=new cateModel();

      if(request()->isPost()){
        $data=input('post.');

        if($art->update($data)){
          $this->success('文章修改成功','article/lst');
        }
        else{
          $this->error('文章修改失败','article/list');
        }
      }

      $id=input('id');
      $list=db('article')->where('id',$id)->find();
      $datas=$cate->cateTree();
      $this->assign(array('data'=>$datas,'list'=>$list));
       return view();
    }

    public function del(){
       $id=input('id');
      if(articleModel::destroy($id)){
         $this->success('文章删除成功','article/lst');
      }
      else{
          $this->error('文章删除失败','article/lst');
      }

    }



   
}
