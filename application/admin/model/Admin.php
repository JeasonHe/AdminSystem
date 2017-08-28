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
        $adminData=array();
           $adminData['name']=$data['name'];
           $adminData['password']=$data['password'];
           

       if($this->save($adminData)){
           $accessData=array();
           $accessData['uid']=$this->id;
           $accessData['group_id']=$data['group_id'];
            db('auth_group_access')->insert($accessData);
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
           $adminData=array();
           $adminData['id']=$data['id'];
           $adminData['name']=$data['name'];
           $adminData['password']=$data['password'];   

       if($this->update($adminData)){
           $accessData=array();
           $accessData['uid']=$data['id'];
           $accessData['group_id']=$data['group_id'];
           if(db('auth_group_access')->where('uid',$data['id'])->update($accessData)){
            return true;
          }
       }
       return false;
    }

    public function login($data){
        $admin=Admin::getByName($data['name']);
        if($admin){
            if($admin['password']==$data['password']){
                session('id', $admin['id']);
                session('name', $admin['name']);
                return 2; //登录密码正确的情况
            }else{
                return 3; //登录密码错误
            }
        }else{
            return 1; //用户不存在的情况
        }

    }
}
