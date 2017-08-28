<?php
namespace app\index\controller;
use think\Model;
class Article extends Model
{
    public function index()
    {
        return view('Article');
    }
}
