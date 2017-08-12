<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
    public function addAdmin($data){
       if(empty($data) || !is_array($data)){
        return false;
       }
       // if($data['password']){
       //     $data['password']=md5($data['password']);
       // }
       if(db('admin')->insert($data)){
        return true;
       }
       else{
        return false;
       }
    }

    public function delAdmin($id){
      return db('admin')->where('id',$id)->delete();
    }

    public function getAdmin(){
      return $this->paginate(8);
    }

    

    public function editAdmin($data){
        return db('admin')->update($data);
    }
}
