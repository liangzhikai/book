<?php
namespace app\admin\model;
use think\Model;
//添加表操作类
use think\Db;
class User extends Model
{
	protected static function init(){
	// $User是指接受到的参数，before_insert 在新增之前执行的静态事件
	 User::event('before_insert',function($user){
	 	//$article为查询出来为对象 
	 	//有post.传过来的查询参数
	 	//['tmp_name']上传服务器临时文件夹之后的文件名，
    	if($_FILES['ava']['tmp_name']){
    		// 获取表单上传文件 
    		$file = request()->file('ava');
    		//将上传文件存放的文件夹
        	$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        	//保存的路径与文件名
        	//服务器写法 
        	// $ava = 'http://127.0.0.1/blog2/'.'public'.DS.'uploads'.'/'.$info->getSaveName();
	        	if($info){
			        	$ava = '/book/'.'/public'.DS.'uploads'.'/'.$info->getSaveName();
			        	$user['ava']= $ava;
			        	//再返回post.接受 数据让或在save()插入		
	        			}
	    		}
	    		
	 });

	      	User::event('before_update',function($user){
          if($_FILES['ava']['tmp_name']){
          		$user=User::find($user->id);
          		$avapath=$_SERVER['DOCUMENT_ROOT'].$user['ava'];
                if(file_exists($avapath)){
                	@unlink($avapath);
                }
                $file = request()->file('ava');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // $ava=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
                    $ava='/book/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $user['ava']=$ava;
                }

            }
      });

      	User::event('before_delete',function($User){
          
          		$user=User::find($User->id);
          		$thumbpath=$_SERVER['DOCUMENT_ROOT'].$user['ava'];
                if(file_exists($thumbpath)){
                	@unlink($thumbpath);
                }
        });
}
	}