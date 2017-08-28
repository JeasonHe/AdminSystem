<?php
namespace app\admin\controller;
use app\admin\model\AuthGroup as authGroups;
use app\admin\model\AuthRule as authRules;
class AuthGroup extends Common
{ 
    public function lst()
    {
       $data=authGroups::paginate(8);
       $this->assign('authGroupRes',$data);
        return view();
    }

    public function add()
    {
      $auth=new authGroups;
      if(request()->isPost()){
        $data=input('post.');
        if(count($data)==2){
          $data['rules']=0;
        }
        else{
          $data['rules']=implode(',', $data['rules']);
        }
        if($auth->save($data)){
            $this->success('用户组添加成功','AuthGroup/lst');
        }
        else{
          $this->error('用户组添加失败','AuthGroup/lst');
        }
      }
      $allAuth=db('authRule')->select();
      $auth=new authRules;
      $data=$auth->getTree($allAuth);
      $this->assign('all',$data);

        return view();
    }

    public function edit()
    {
      $auth=new authGroups;
      if(request()->isPost()){
        $data=input('post.');
         if(count($data)==2){
          $data['rules']=0;
        }
        else{
          $data['rules']=implode(',', $data['rules']);
        }
        if($auth->update($data)){
            $this->success('用户组修改成功','lst');
        }
        else{
          $this->error('用户组修改失败','lst');
        }
      }
       $id=input('id');
       $data1=authGroups::where('id',$id)->find();
       $auth=new authRules;
        $allAuth=db('authRule')->select();
      $data=$auth->getTree($allAuth);
       $this->assign(array('authgroups'=>$data1,'all'=>$data));
       return view();
    }

    public function del($id){
      
      if(db('auth_group')->delete($id)){
        $this->success('删除用户组成功','lst');
      }
      else{
        $this->error('删除用户组失败','lst');
      }
    }


   
}
