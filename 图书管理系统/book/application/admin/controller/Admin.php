<?php
namespace app\admin\controller;
use app\admin\model\Admin  as AdminModel;
//继承了common的公共控制器的初始方法
use app\admin\controller\Common;
class  Admin extends Common{

		public function lst(){ 
			
			//新建auth类对象,使用 session（）取到id的值，然后进行查询
			// $auth = new Auth();
			// $groups=$auth->getGroups(session('id'));
			// dump($groups);die;
			$admin = new AdminModel();
			//箭头指向调用的model的方法
			$adminres = $admin ->getadmin();
			//进行分页处理
			$this->assign('adminres',$adminres);
			return view('admin/list');

		}

	  //添加用户
	  public function add(){
	  	//使用多种方法插入数据
	  	// 第一种
	  	if(request()->isPost()){
	  	 	$data=input('post.');
	  	 	dump($data);
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }   
	  		$admin = new AdminModel();

	  		if($admin->addadmin($data)){

	  			$this->success('添加管理员成功!',url('admin/lst'));

	  		}else{
	  			$this->error('添加管理员失败！');
	  		}
	  	}

	  	 return view('admin/add');
	  }
	  //修改用户,$id所接收到的id
	   public function edit($id){
	   	//编辑键传过来的id 上面需要接受方法($id);
		$admins=db('admin')->find($id);
	   	if(request()->isPost()){
	   		//接受到的数据
	  		 $data = input('post.');
            //新建validaate验证类
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }     

	   		$admin = new AdminModel();
	   		$savenum = $admin->saveadmin($data,$admins); 
	   		if($savenum=='2'){
				$this->error('管理用户名不能为空!');	   			
	   		}
			   		if($savenum !== false){
			   			$this->success('修改成功！',url('admin/lst'));
			   		}else{
			   			$this->error('修改失败！');
			   		}
	   		}
	   	//判断用户是否存在
		if(!$admins){
				$this->error('该管理员不存在！');
			}
		 $this->assign('admins',$admins); 
	  	 return view('admin/edit');
	  }
	  //用户删除
	  public function del($id){
	  $admin = new AdminModel();
	  $delnum = $admin->deladmin($id);
	  //判断其返回的值
	  if($delnum = '1'){
	  		$this->success('删除成功！','admin/lst');
	  }else{
	  		$this->error('修改失败!');
	  }
	  }
	  //用户退出
	    public function logout(){
        session(null); 
        $this->success('退出系统成功！',url('login/index'));
    }
	 
}