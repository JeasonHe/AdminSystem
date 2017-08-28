<?php
namespace app\admin\controller;
use app\admin\model\AuthRule as authRules;
class AuthRule extends Common
{ 
    
    public function lst()
    {
      $rule=new authRules;
       $arr=authRules::select();
       $data=$rule->getTree($arr);

       $this->assign('authRuleRes',$data);
        return view();
    }

    public function add()
    {
      $auth=new authRules;
      if(request()->isPost()){
        $data=input('post.');
  
        if($auth->save($data)){
            $this->success('权限添加成功','lst');
        }
        else{
          $this->error('权限添加失败','lst');
        }
      }
       $arr=authRules::select();
       $data=$auth->getTree($arr);
       $this->assign(array('rules'=>$data));
        return view();
    }

    public function edit()
    {
      $auth=new authRules;
      if(request()->isPost()){
        $data=input('post.');
        if($auth->update($data)){
            $this->success('权限修改成功','lst');
        }
        else{
          $this->error('权限修改失败','lst');
        }
      }
       $id=input('id');
       $data=authRules::where('id',$id)->find();
       $arr=authRules::select();
       $rule=$auth->getTree($arr);
       $this->assign(array('authRules'=>$data,'rules'=>$rule));
       return view();
    }

    public function del($id){
      $ruleModel=new authRules;
      $ruleModel->delAll($id);
      if(authRules::destroy($id)){
        $this->success('删除权限成功','lst');
      }
      else{
        $this->error('删除权限失败','lst');
      }
    }


   
}
