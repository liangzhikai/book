<?php
namespace app\home\controller;
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
class  Common extends Controller{
		// //初始化方法
	 // public function _initialize(){
  //       if(!session('id') || !session('name')){
  //          $this->error('您尚未登录系统',url('login/index')); 
  //       }
  //   }
}