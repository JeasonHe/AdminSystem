<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate
{
   protected $rule=[
      ['name','unique:admin|require','该管理员已存在|管理员名称不为空'],
   ];

   protected $scene=[
       'add'=>['name'],
       'edit'=>['name'],
   ];
}
