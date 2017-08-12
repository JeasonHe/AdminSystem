<?php
namespace app\admin\controller;
use think\Controller;
class Common extends Controller
{
    public function _initialize(){
        if(!session('id') || !session('name')){
            $this->error('您尚未登录本系统','login/index');
        }
    }
   
}
