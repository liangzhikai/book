<?php
namespace app\admin\controller;
use app\admin\model\Cate  as CateModel;
//继承了common的公共控制器的初始方法
use app\admin\controller\Common;
use app\admin\model\Article  as ArticleModel;
class  Cate extends Common{
	//前置方法
	  protected $beforeActionList = [
 
        'delsoncate'  =>  ['only'=>'del'],
    ];
	public function lst(){
		$cate = new CateModel();
		 if(request()->isPost()){

		 	$sort = input('post.');
		 	foreach($sort as $k =>$v){
		 		//以数组的形式存放是[] 
		 	 $cate->update(['id'=>$k,'sort'=>$v]);
		 	}
		 	$this->success('更新成功！',url('cate/lst'));
		 	//中断下面的操作
		 	return;
		 }
		$cateres=$cate->catetree();
		$this->assign('cateres',$cateres);
		return view('cate/list');		
	}

	public function add(){
		//新建model对象
		$cate = new CateModel();
		//栏目插入
		if( request()->isPost()){
		$data = input('post.');
		$res = $cate->save($data);
		if($res){
			$this->success('添加成功',url('cate/lst'));
		}else{
			$this->error('添加失败',url('cate/add'));
		}	
	}
	 //查询分配
	  $cateres = $cate->catetree();
	  $this->assign('cateres',$cateres);
	 return view('cate/add'); 
	}
	//进行删除
 	  public  function  del(){
 	  	//使用db的时候条件是在delete里面进行添加
 	  	 $del = db('cate')->delete(input('id'));
 	  	 if($del){
 	  	 	$this->success('删除栏目成功',url('cate/lst'));
 	  	 }else{
 	  	 	$this->success('删除栏目失败');
 	  	 }
 	  } 
	//删除前执行的方法  //查询到他下面的所有的子栏目
	public function delsoncate(){
	  $cateid =	input('id');//要删除的当前id
	  $cate = new CateModel();
	  $sonids = $cate ->getchilrenid($cateid);

	  //遍历出来的所有栏目包后子栏目
	  $allcateid = $sonids;
	  //将栏目的id $cateid 与子栏目的id $conids 都都放在里面了,
	  //[]相当于在后面追加一个元素
	  $allcateid[] = $cateid;

	  // 使用遍历的方法删除掉article,假如是23，中国的广东栏目23，23号栏目对应的值是v是23 
	  // 下面所属文章排序出来的索引数组
	  foreach ($allcateid as $key => $value) {
	  	 $article = new ArticleModel;
	  	 $article->where(array('cateid'=>$value))->delete();
	  }
	  //判断存在数据的时候
	  if($sonids){
	  	db('cate')->delete($sonids);

	   }
	}	
	//实现修改功能
	public  function edit(){
		//建立对象model
		$cate = new CateModel();
		//如果你是表单提交过来
		if(request()->isPost()){
			//使用过修改的时候需要添加主键
			$save  = $cate->save(input('post.'),['id'=>input('id')]);
			if($save !== false){
 	  	 	$this->success('修改栏目成功',url('cate/lst'));
 	  	 }else{
 	  	 	$this->success('修改栏目失败');
 	  	 }
			//下面的就不去执行
			return; 
		}
		//查询展示所有修改的数据对象
		$cateres=$cate->catetree();
		//根据传过来的id进行查询出来的数据
		$cates = $cate->find(input('id'));
		$this->assign(array(
			  //多变量分配
			  'cateres'=>$cateres,
			  'cates'=>$cates
			));

		return view('cate/edit');
	}
}