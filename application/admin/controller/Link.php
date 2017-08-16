<?php
namespace app\admin\controller;
use app\admin\validate;
class Link extends Common
{
    
    public function lst()
    {
      $datas=db('link')->paginate(8);
      $this->assign('List',$datas);
        return view();
    }

    public function add()
    {
      if(Request()->isPost()){
        $data=input('post.');
        $result = $this->validate($data,'Link.add');
        if ($result !== true) {
            $this->error($result);
        }
       
        if(db('link')->insert($data)){
          $this->success('新增链接成功','ink/lst');
        }
        else{
          $this->error('新增链接失败','link/add');
        }
      }

        return view();
    }

    public function edit()
    {
        if(Request()->isPost()){
          $data=input('post.');
          $result = $this->validate($data,'Link.edit');
        if ($result !== true) {
            $this->error($result);
        }
          if(db('link')->where('id',$data['id'])->update($data)){
            $this->success('修改链接信息成功','link/lst');
          }
          else{
            $this->error('修改链接信息失败','link/lst');
          }
        }
        $id=input('id');
        $list=db('link')->where('id',$id)->find();
        $this->assign(array('data'=>$list));

       return view();
    }

    public function del($id){
      
      if(db('link')->delete($id)){
        $this->success('删除链接成功','link/lst');
      }
      else{
        $this->error('删除链接失败','link/lst');
      }
    }


   
}
