<?php
namespace app\index\controller;
class Search extends Common
{
    public function index()
    {
    	$keyword=input('word');
    	$data=db('article')->where('tittle','like','%'.$keyword.'%')->paginate(5);
    	$this->assign(array(
    		'result'=>$data,
    		'count'=>count($data),
    		'keyword'=>$keyword
    		));
        return view('search');
    }
}
