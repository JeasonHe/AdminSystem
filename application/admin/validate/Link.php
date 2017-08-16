<?php
namespace app\admin\validate;
use think\Validate;
class Link extends Validate
{
    protected $rule=[
      'tittle'=>'require|unique:link|max:50',
      'description'=>'require|max:150',
      'link'=>'url|unique:link|max:100',

    ];

    protected $message=[
      'tittle.require'=>'标题不为空',
      'tittle.unique'=>'标题已存在',
      'tittle.max'=>'标题最大长度50',
      'description.require'=>'描述不为空',
      'description.max'=>'描述最大长度150字',
      // 'link.require'=>'链接不为空',
      'link.url'=>'链接格式不正确',
      'link.unique'=>'链接已存在',
      'link.max'=>'链接最大长度100',
    ];

    protected $scene=[
      'add' => ['tittle','link','description'],
      'edit' => ['tittle','link','description'],
    ];

   
}
