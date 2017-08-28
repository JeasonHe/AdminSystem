<?php
namespace app\admin\controller;
use app\admin\model\Admin;
use think\Controller;
class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            $this->check(input('code'));
          $admin=new Admin();
          $num=$admin->login(input('post.'));
          if($num==1){
            $this->error('用户不存在！','');
          }
          if($num==2){
            $this->success('登录成功！',url('index/index'));
          }
          if($num==3){
            $this->error('密码错误！','');
          }
          return;
        }
        return view();
    }

    public function check($code='')
    {
        if (!captcha_check($code)) {
            $this->error('验证码错误','login/index');
        } else {
            return true;
        }
    }
}
