<?php
namespace app\admin\model;
use think\Model;
class Article extends Model
{
  public static function init(){
    Article::event('before_insert',function($data){
      if($_FILES['pic']['tmp_name']){
        $file=request()->file('pic');
        $thumb=$file->move(ROOT_PATH.'public'.DS.'uploads');
        if($thumb){
          $pic='/bike/'.'public'.DS.'uploads'.'/'.$thumb->getSaveName();
          $data['pic']=$pic;
        }
      }
    });


    Article::event('before_update',function($data){
       $arts=Article::find($data->id);
           //找图片所在路径要用完整路径来查找，相对路径不管用
           $picPath=$_SERVER['DOCUMENT_ROOT'].$arts['pic'];
           if(file_exists($picPath)){
                @unlink($picPath);
           }

      if($_FILES['pic']['tmp_name']){
        $file=request()->file('pic');
        $thumb=$file->move(ROOT_PATH.'public'.DS.'uploads');
        if($thumb){
          $pic='/bike/'.'public'.DS.'uploads'.'/'.$thumb->getSaveName();
          $data['pic']=$pic;
        }
      }
    });
   
    Article::event('before_delete', function ($user) {
           $arts=Article::find($user->id);
           //找图片所在路径要用完整路径来查找，相对路径不管用
           $picPath=$_SERVER['DOCUMENT_ROOT'].$arts['pic'];
           if(file_exists($picPath)){
                @unlink($picPath);
           }
          
        });



  }
  
}
