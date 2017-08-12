<?php
namespace app\admin\controller;
use think\Controller;
class Login extends Controller
{
    public function index()
    {
    	if(request()->isPost()){
            $data=input('post.');
   
            $admin=db('admin')->where('name',$data['name'])->find();
            
            if($admin){
               if($admin['password']==$data['password']){
               	 session('name',$admin['name']);
               	 session('id',$admin['id']);
               	$this->success('欢迎进入后台管理系统','index/index');

               }
               else{
               	$this->error('密码不正确，请确认后重新输入','');
               }
            }
            else{
    		   $this->error('用户不存在','');
    	    }
    	}
    	
        return view();
    }
}
