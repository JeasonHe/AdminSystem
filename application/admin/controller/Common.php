<?php
namespace app\admin\controller;
use think\Controller;
class Common extends Controller
{
    public function _initialize(){
        if(!session('id') || !session('name')){
            $this->error('您尚未登录本系统','login/index');
        }

        $auth=new Auth;
        $str=$this->request->controller().'/'.$this->request->action();
        $notCheck=array('Index/index','Admin/logout');
        if(!in_Array($str,$notCheck)){
          if(!$auth->check($str,session('id'))){
         	$this->error('您没有该操作权限','Index/index');
           }
        }

    }
   
}
