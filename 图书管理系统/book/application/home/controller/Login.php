<?php
namespace app\home\controller;
use app\home\controller\Common;
class  Login extends Common{
		public function  index(){
			if(request()->ispost()){
				//验证码
				$this->check(input('code'));
				$data = input('post.');
				dump($data);
				$res = db('user')->where(array('name'=>$data['name'],'personal'=>$data['personal']))->find();
				session('id', $res['id']);
                session('name', $res['name']);
				    if($res){
			            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			            $this->success('登陆成功', 'home/index');
			        } else {
			            //错误页面的默认跳转页面是返回前一页，通常不需要设置
			            $this->error('账号或者密码错误请重新进行填写！');
			        }

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
 