<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\User as UserModel;
class  User extends Common{

	//添加用户
	  public function add(){
	  	//使用多种方法插入数据
	  	// 第一种
	  	if(request()->isPost()){
	  	 	$data=input('post.');
	  	 	$data['credit'] = 100;
	  	 	//图片处理许用到model，不能用db
	  	 	$user = new UserModel;
			$res = $user->save($data);	  
	  		if($res){

	  			$this->success('添加读者成功!');

	  		}else{
	  			$this->error('添加读者失败！');
	  		}
	  	}
	  	 return view('user/add');
	  }

	    public function lst(){
    	//使用关联表查询 alias（'a'）别名 join（表名，别名，'a的id字段=b.的id字段'）,field()指端字段名查询a字段的全部，b的catename，
    	$useres = db('user')->paginate(8);
    	$this->assign('useres',$useres);
    	return view('user/list');
    }


    public function edit(){
    	//不要使用die，要使用return返回即可中断
    
    	if(request()->isPost()){
    		//插入有图片的是由应该使用模型，就可以使用模型事件
            $user = new UserModel;
            //接受数据进行验证
             $data = input('post.');
            //新建validaate验证类
    		//因为post里面已经传进来了主键id
    		$save = $user->update($data);
    		// $save = db('user')->update(input('post.'));

    		if($save){
    			$this->success('更新读者信息成功',url('user/lst'));
    		}else{
    			$this->error('更新读者失败!');
    		}
    	}	
    	//find返回的是一维数组，select返回的是二维数组
    	$useres = db('user')->where(array('id'=>input('id')))->find();
		$this->assign(array(
			'useres'=>$useres
			));

     return  view('user/edit');
    }
    //删除
   	public function del(){
   		//使用静态方法进行创建model
   		//不用创建对象的方法
   		if(UserModel::destroy(input('id')))
   		{
    			$this->success('删除读者信息成功！',url('user/lst'));
    		}else{
    			$this->error('更新读者信息失败!');
    		}
   	}

	}