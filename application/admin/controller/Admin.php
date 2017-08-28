<?php
namespace app\admin\controller;
use app\admin\model\Admin as adminModel;
use app\admin\validate;
class Admin extends Common
{
    public function lst()
    {
        $auth=new Auth;
        $model=new adminModel();
        $adminRes=$model->paginate(8);
        foreach ($adminRes as $k => $v) {
           $data=$auth->getGroups($v['id']);
           $v['title']=$data[0]['title'];
        }
        $this->assign('adminRes',$adminRes);
        return view();
    }

    public function add()
    {
        if(request()->isPost()){
           $data=input('post.');

           $result=$this->validate($data,'Admin.add');
           if($result !== true){
              $this->error($result);
           }
           $model=new adminModel();
           $res=$model->addAdmin($data);
           if($res){
              $this->success('新增成功', 'admin/lst');
           }
           else{
               $this->error('新增失败', 'admin/add');
           }
         
      }
      $data=db('authGroup')->select();
      $this->assign('list',$data);
        return view();
    }

    public function edit($id)
    {
        $model=new adminModel();
        $da=input('post.');
        if(request()->isPost()){
            $data=$model->editAdmin($da);

            $result=$this->validate($da,'Admin.edit');
           if($result !== true){
              $this->error($result);
           }

            if($data){
                $this->success('修改管理员信息成功','admin/lst');
            }
            else{
                $this->error('修改管理员信息失败','');
            }
       }

        $data=db('admin')->find($id);
        $dat=db('authGroup')->select();
        $da=db('authGroupAccess')->find($id);

        $this->assign(array('data'=>$data,'list'=>$dat,'access'=>$da));

       return view();
    }


    public function del($id){
         $model=new adminModel();

        if(!empty($id)){
            if($model->delAdmin($id)){
                $this->success('删除成功', 'admin/lst');
            }
            else{
                $this->error('删除失败', 'admin/lst');
            }
            return ;
        }
        return false;
    }

    public function logout($id){
        session(null);
        $this->success('成功退出系统','login/index');
    }

    
}
