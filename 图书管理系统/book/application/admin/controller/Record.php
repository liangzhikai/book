<?php
namespace app\admin\controller;
use app\admin\model\Article  as ArticleModel;
use app\admin\model\Cate  as CateModel;
//继承了common的公共控制器的初始方法
use app\admin\controller\artilcle;
class  Record extends Common{
	public function lst(){
		//查询到所有的记录
		$recordes = db('record')->select();
		// dump($recordes);
		// return;
		$this->assign('recordes',$recordes);
		return  view('record/record');

	}
	public  function  del(){
	if(request()->isGet()){
		$res = db('record')->where('id',input('id'))->delete();
		if($res){
    			$this->success('删除记录成功');
    		}else{
    			$this->error('删除记录失败!');
    		}
    		
    	}
    }
	
}