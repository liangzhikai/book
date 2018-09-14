<?php
namespace app\home\controller;
use app\home\controller\Common;
class  Home extends Common{
		public function  index(){
			//查询热门排行
			$rank=db('article')->order('loan desc')->limit('10')->select();
			//查询到热门书籍
			$readre=db('article')->order('id desc')->limit('9')->select();
			// $this->assign('rank',$rank);
			$this->assign(array(
				'rank'=>$rank,
				'readre'=>$readre,
				));
			return  view('home/index');
		}


}
