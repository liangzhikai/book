<?php
namespace app\admin\model;
use think\Model;
//添加表操作类
use think\Db;
class Admin extends Model
{

   public function addadmin($data){
    //判断文件是否接受的数据是否为空，判断是否为数组
    if(empty($data) || !is_array($data)){
        return false;
    }
    if($data['password']){
        $data['password']=md5($data['password']); 
    } 
    //添加用户，admin添加表用户
    $adminData = array();
    $adminData['name']=$data['name'];
    $adminData['password']=$data['password'];

    if($this->save($adminData)){
        return true;
    }else{ 
        return false;
    }

}
  public  function  getadmin(){

    return $this::paginate(5);
  }

public function  saveadmin($data,$admins){
        //在数据面前在！，表示如果数据为空的时候
                //判断用户是否为空
                if(!$data['name']){
                    //如果管理员为空的就向控制器返回字符串2
                    return 2;
                }
                //判断密码
                if(!$data['password']){
                    //用到了admins的表
                    $data['password']=$admins['password'];
                }else{
                    $data['password'] = md5($data['password']);
                }
                             
              
                //方法二$this::表示是当前这个model执行这个类
                return $this::update(['name'=>$data['name'],'password'=>$data['password']],
                        ['id' => $data['id']]);
}
    //根据用户删除
    public function deladmin($id){
        if($this::destroy($id)){
            return 1;
        }else{
            return 2;
        }
    }
    //用户登陆login
 
    public function login($data){
        $admin=Admin::getByName($data['name']);
        if($admin){
            if($admin['password']==md5($data['password'])){
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
