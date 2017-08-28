<?php
namespace app\index\model;
use think\Model;
class Page extends Model
{
    public function index()
    {
        return view('Page');
    }
}
