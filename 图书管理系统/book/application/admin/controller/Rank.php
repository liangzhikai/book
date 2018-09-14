<?php
namespace app\admin\controller;
use app\admin\model\Admin  as AdminModel;
//继承了common的公共控制器的初始方法
use app\admin\controller\Common;
class  Rank extends Common{

		public function lst(){
			//通过销量的正序进行排序
		$rank=db('article')->order('loan desc')->limit('10')->select();
		$this->assign('rank',$rank);
		return  view('rank/rank');

		}



	}