<?php
namespace app\index\controller;
class Index extends Common
{
    public function index()
    {
    	$data=db('article')->where('push','=','1')->select();
    	$topArt=db('article')->order('click')->limit(10)->select();
    	$friendLink=db('link')->select();
    	$this->assign(array('top'=>$data,'topRead'=>$topArt,'link'=>$friendLink));

        return view('index');
    }
}
