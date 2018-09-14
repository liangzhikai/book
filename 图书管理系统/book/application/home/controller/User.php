<?php
namespace app\home\controller;
use app\home\controller\Common;
class  User extends Common{

		public function index(){ 
		$data = input('id');
		$map['a.id'] = input('id');
		$user = db('user')->where('id',input('id'))->find();
		//查询到所有借的书
		$borrowes = db('user')->field('a.*,b.book_number,b.book_title')->alias('a')->join('bk_brrow b','a.id=b.user_id')->where($map)->select();
		//查询到借书记录
		$recordes = db('record')->where('user_id',input('id'))->select();
		// dump($recordes);
		// return;
		$this->assign('recordes',$recordes);
         
		$this->assign(array(
			'user' =>$user,
			'borrowes'=>$borrowes,
			'recordes'=>$recordes,

			));

		return view('user/index');

		}
	}