<?php
namespace app\admin\controller;

class Index
{
	public function _initialize(){
        if(!session('id') || !session('name')){
            $this->error('您尚未登录本系统','login/index');
        }
    }
    public function index()
    {
        return view();
    }
}
