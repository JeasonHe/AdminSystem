<?php
namespace app\admin\controller;
use app\admin\model\Conf as ConfModel;
use app\admin\controller\Common;
class Conf extends Common
{

    public function lst(){
        if(request()->isPost()){
            $sorts=input('post.');
            $conf=new ConfModel();
            foreach ($sorts as $k => $v) {
                $conf->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('lst'));
            return;
        }
        $confres=ConfModel::order('sort desc')->paginate(4);
        $this->assign('confres',$confres);
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            // $validate = \think\Loader::validate('Conf');
            // if(!$validate->check($data)){
            //     $this->error($validate->getError());
            // }
            if($data['val']){
                $data['val']=str_replace('，', ',', $data['val']);
            }
            $conf=new ConfModel();
            if($conf->save($data)){
                $this->success('添加配置成功！',url('lst'));
            }else{
                $this->error('添加配置失败！');
            }
        }
        return view();
    }

    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            // $validate = \think\Loader::validate('Conf');
            // if(!$validate->scene('edit')->check($data)){
            //     $this->error($validate->getError());
            // }
            if($data['val']){
                $data['val']=str_replace('，', ',', $data['val']);
            }
            $conf=new ConfModel();
            $save=$conf->save($data,['id'=>$data['id']]);
            if($save!==false){
                $this->success('修改配置成功！',url('lst'));
            }else{
                $this->error('修改配置失败！');
            }
        }

        $confs=ConfModel::find(input('id'));
        $this->assign('confs',$confs);
        return view();
    }

    public function del(){
        $del=ConfModel::destroy(input('id'));
        if($del){
           $this->success('删除配置项成功！',url('lst')); 
        }else{
            $this->error('删除配置项失败！');
        }
    }

    public function conf(){
        if(request()->isPost()){
            $data=input('post.');
            //获取提交上来的字段名
            $dataArr=Array();
            foreach($data as $k=>$v){
                $dataArr[]=$k;
            }
            //从数据表获取所有的英文字段名
            $_allArr=array();
            $_allArr=db('conf')->field('enname')->select();
            $allArr=array();
            foreach ($_allArr as $k => $v) {
                $allArr[]=$v['enname'];
            }
            $checkArr=array();
            foreach($allArr as $k=>$v){
                if(!in_array($v,$dataArr)){
                    $checkArr[]=$v;
                }
            }
            if($checkArr)
            {
                foreach($checkArr as $k=>$v){
                 db('conf')->where('enname',$v)->update(['value'=>'']);
                }
            }
            foreach ($data as $k => $v) {
                db('conf')->where('enname',$k)->update(['value'=>$v]);
            }

           

        }
        $confres=ConfModel::order('sort desc')->select();
        $this->assign('confres',$confres);
        return view();
    
    }





    

    




   

	












}
