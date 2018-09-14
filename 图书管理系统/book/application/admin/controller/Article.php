<?php
namespace app\admin\controller;
use app\admin\model\Article  as ArticleModel;
use app\admin\model\Cate  as CateModel;
//继承了common的公共控制器的初始方法
use app\admin\controller\artilcle;
class   article extends Common{
    public function lst(){
        //$map['a.id'] = input('id');
    	//使用关联表查询 alias（'a'）别名 join（表名，别名，'a的id字段=b.的id字段'）,field()指端字段名查询a字段的全部，b的catename，
        //打了paginate就可以不使用select（）；
    	$artres = db('article')->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid=b.id')->order('id desc')->paginate(5);
    	$this->assign('artres',$artres);
    	return view('article/list');
    }
    public function add(){
    	if(request()->isPost()){
            $article = new ArticleModel;
    		$data = input('post.');
            $data['iy'] = $data['gi']; 
            //新建validaate验证类
            $validate = \think\Loader::validate('Article');
            if(!$validate->scene ('add')->check($data)){
                $this->error($validate->getError());
            }       
    		// 使用save保存的时候，是不需要添加主键， 但是为其更新就需要添加主键，或者参数李面有主键id
    	if($article ->save($data)){
    			$this->success('添加图书信息成功',url('article/lst'));
    		}else{
    			$this->error('添加图书信息失败!');
    		}
    		return;
    	}
    	$cate = new CateModel();
    	$cateres=$cate->catetree();
		$this->assign('cateres',$cateres);
    	return view('article/add');
    }

    public function edit(){
    	//不要使用die，要使用return返回即可中断
    
    	if(request()->isPost()){
    		//插入有图片的是由应该使用模型，就可以使用模型事件
            $article = new ArticleModel;
            //接受数据进行验证
             $data = input('post.');
            //新建validaate验证类
            $validate = \think\Loader::validate('Article');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }     
    		//因为post里面已经传进来了主键id
    		$save = $article->update($data);
    		// $save = db('article')->update(input('post.'));

    		if($save){
    			$this->success('更新图书信息成功',url('article/lst'));
    		}else{
    			$this->error('更新图书信息失败!');
    		}
    	}	
    	$cate = new CateModel();
    	$cateres=$cate->catetree();
    	//find返回的是一维数组，select返回的是二维数组
    	$arts = db('article')->where(array('id'=>input('id')))->find();
		$this->assign(array(
			'cateres'=>$cateres,
			'arts'=>$arts
			));

     return  view('article/edit');
    }
    //删除
   	public function del(){
   		//使用静态方法进行创建model
   		//不用创建对象的方法
   		if(ArticleModel::destroy(input('id')))
   		{
    			$this->success('更新图书信息成功',url('article/lst'));
    		}else{
    			$this->error('更新图书信息失败!');
    		}
   	}
}

	
	
