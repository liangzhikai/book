<?php
namespace app\admin\controller;
use app\admin\model\Admin  as AdminModel;
//继承了common的公共控制器的初始方法
use app\admin\controller\Common;
class    Search extends Common{
	public  function index(){
	$data = input('searchdata');
	


   $map['title']  = ['like','%'.$data.'%'];
    
	$artres = db('article')->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid=b.id')->order('id desc')->where(	$map)->paginate(5);
    	$this->assign('artres',$artres);
   return view('Search/index');
}

}