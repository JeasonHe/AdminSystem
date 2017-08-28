<?php
namespace app\index\controller;
use app\index\model\Artlist as artlists;
class Artlist extends Common
{
    public function index()
    {

    	$id=input('id');
    	$string=$this->getCateChild($id);
    	$pos=$this->getParents($id);
    	$data=db('article')->where('cateid','in',$string)->paginate(6);
  
    	$this->assign('artList',$data);
        return view('artlist');
    }

}
