<?php
namespace app\admin\controller;
use app\admin\model\Admin as adminModel;
class Admin extends Common
{
    public function lst()
    {
        $model=new adminModel();
        $adminRes=$model->getAdmin();
        $this->assign('adminRes',$adminRes);
        return view();
    }

    public function add()
    {
        if(request()->isPost()){
           $data=input('post.');
           $model=new adminModel();
           $res=$model->addAdmin($data);
           if($res){
              $this->success('新增成功', 'admin/lst');
           }
           else{
               $this->error('新增失败', 'admin/add');
           }
          return true;
      }
        return view();
    }

    public function edit($id)
    {
        $model=new adminModel();

        if(request()->isPost()){
            $data=$model->editAdmin(input('post.'));
            if($data){
                $this->success('修改管理员信息成功','admin/lst');
            }
            else{
                $this->error('修改管理员信息失败','');
            }
        return ;
       }

        $data=db('admin')->find($id);

        $this->assign('data',$data);

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
