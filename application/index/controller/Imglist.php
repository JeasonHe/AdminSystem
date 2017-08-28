<?php
namespace app\index\controller;
use app\index\model\Imglist as Imglists;
class Imglist extends Common
{
    public function index()
    {
    	$id=input('id');
    	$string=$this->getCateChild($id);
    	$data=db('article')->where('cateid','in',$string)->paginate(8);
  
    	$this->assign('ImgList',$data);
        return view('Imglist');
    }
}
