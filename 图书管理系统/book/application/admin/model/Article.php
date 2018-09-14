<?php
namespace app\admin\model; 
use think\Model;
//添加表操作类
use think\Db;
class Article extends Model{ 
	protected static function init(){
	// $article是指接受到的参数，before_insert 在新增之前执行的静态事件
	 Article::event('before_insert',function($article){
	 	//$article为查询出来为对象
	 	//有post.传过来的查询参数
	 	//['tmp_name']上传服务器临时文件夹之后的文件名，
    	if($_FILES['thumb']['tmp_name']){
    		// 获取表单上传文件 
    		$file = request()->file('thumb');
    		//将上传文件存放的文件夹
        	$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        	//保存的路径与文件名
        	//服务器写法 
        	// $thumb = 'http://127.0.0.1/book/'.'public'.DS.'uploads'.'/'.$info->getSaveName();
	        	if($info){
			        	$thumb = '/book'.'/public'.DS.'uploads'.'/'.$info->getSaveName();
			        	$article['thumb']= $thumb;
			        	//再返回post.接受 数据让或在save()插入		
	        			}
	    		}
	    		
	 });


		// $article是指接受到的参数，before_insert 在修改之前执行的静态事件
	 Article::event('before_update',function($article){
	 // 	//$article为查询出来为对象
	 // 	//有post.传过来的查询参数
	 // 	//['tmp_name']上传服务器临时文件夹之后的文件名，
    	if($_FILES['thumb']['tmp_name']){
    		//使用Article模型$article参数里面的id
    		$arts = Article::find($article->id);
    		//加上wwww的的详细地址，删除的时候就删除这个地址，不然无法查询到该地址
    		$thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
    		//判断路径文件是否存在
    		if(file_exists($thumbpath)){
    			@unlink($thumbpath);
    		}
    		// 获取表单上传文件 
    		$file = request()->file('thumb');
    		//将上传文件存放的文件夹
        	$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        	//保存的路径与文件名
        	//服务器写法 
        	// $thumb = 'http://127.0.0.1/book/'.'public'.DS.'uploads'.'/'.$info->getSaveName();
	        	if($info){
			        	$thumb = '/book'.'/public'.DS.'uploads'.'/'.$info->getSaveName();
			        	$article['thumb']= $thumb;
			        	//再返回post.接受 数据让或在save()插入		
	        			}

	    		}
	    		

	 });

	 	// $article是指接受到的参数，before_insert 在修改之前执行的静态事件
	 Article::event('before_delete',function($article){
	 // 	//$article为查询出来为对象
	 // 	//有post.传过来的查询参数
	 // 	//['tmp_name']上传服务器临时文件夹之后的文件名，
    	
    		//使用Article模型$article参数里面的id
    		$arts = Article::find($article->id);
    		//加上wwww的的详细地址，删除的时候就删除这个地址，不然无法查询到该地址
    		$thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
    		//判断路径文件是否存在
    		if(file_exists($thumbpath)){
    			@unlink($thumbpath);
    		}
    	

	    		
	    		

	 });

	}
		}
			