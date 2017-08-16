<?php
namespace app\admin\Validate;
use think\Validate;
class Cate extends Validate
{
    protected $rule=[
      ['cateName','unique:cate|require|max:25','该栏目已存在|cateName不可为空|cateName最大长度为25'],
    ]

    protected $scene=[
      'add'=>['cateName'],
      'edit'=>['cateName'],
    ];
   
}
