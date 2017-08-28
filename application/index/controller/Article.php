<?php
namespace app\index\controller;

class Article extends Common
{
    public function index()
    {
    	$id=input('id');
    	$data=db('article')->where('id','=',$id)->find();
    	$this->getParents($id);
    	$sameCate=db('article')->where('cateid',$data['cateid'])->where('id','neq',$id)->limit(5)->select();

        $this->assign(array('art'=>$data,'same'=>$sameCate));
        return view('Article');
    }
}
