<?php
namespace app\admin\controller;
//引入基础控制器类
use think\Controller;
//引入验证类
use think\Validate;
//启动session值
use think\Session; 
//引入请求类,因为上传需要
use think\Request;
//引入图片类
use think\Image;
//添加表操作类
use think\Db;
//引入adminmodel类
use app\admin\model\Admin  as AdminModel;
class  Login extends Controller{
	public function index()
	{
		if(request()->isPost()){
		//验证码
		$this->check(input('code'));
		//用户登陆验证
		$admin = new AdminModel;
		$data = input('post.');
		$num= $admin->login($data);
		if($num=='1'){
			$this->error('用户不存在!');
		}
		if($num=='2'){
			$this->success('登陆成功！',url('admin/lst'));
		}
		if($num=='3'){
			$this->error('密码错误！');
		}
		return;
	}
	return view('login/index');
}
		
	//验证码验证
	public function check($code=''){
		//新建函数的对象进行验证
		$captcha = new \think\captcha\Captcha();
		if(!$captcha->check($code)){
			$this->error('验证码错误!');
		}else{
			return  true;
		}

	}
} 
