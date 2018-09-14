<?php
namespace app\admin\model; 
use think\Model;
//添加表操作类
use think\Db;
class Cate extends Model{ 
	public function catetree(){
		//以降序查询出来,
		$cateteres=$this->order('sort desc')->select();
		//对数组进行升序进行显示,sort为下面的函数,进行无限级分类
	    return	$this->sort($cateteres);
	}
	public function  sort($data,$pid=0,$level=0){
		//新建一个静态数组
		static $arr = array();
		// 将$data的值便利出来，赋值给 $v,将排序好的数据
		foreach($data as $k => $v){  
			//if段
			if($v['pid']==$pid){
				//暂时新建存放数据表字段，二真正是没有这个字段的，$leave 为 0 ，从0开始
				$v['level'] = $level;
				//$arr里面的数组放进$arr里面【】，连同$level也增加到里面去，给原来的那条数据加上$level字段，
				//形成一条顶级栏目数据
				$arr[] = $v;
				//进行排序  当前栏目的的id 找当前栏目的子id
				//使用递归方法$thi->sort(),自己执行自己,是一个递归函数
				//对数组进行排序，子栏目的pid是跟顶级栏目id相等，根据他查找下级
				//如果是下一级的level就加一,变成2就+1,成为三一直加下去
				//$data所有的数据，
				$this->sort($data,$v['id'],$level+1);

			}
			

		}
		return  $arr;
	}
	//删除cate的表
	public function  getchilrenid($cateid){
		 	$cateres=$this->select();
		 	return $this->_gerchilrenid($cateres,$cateid);	
	} 
	//cate
	public function _gerchilrenid($cateres,$cateid){
			//新建一个空数组，将每一次循环找到的数据给存起来
			static $arr = array();
			//循环所有数据，找到当前id$cateid,相等的数值	
		
			foreach ($cateres as $k => $v){
			//判断所有数据的pid，与每次递归出来的id
			if($v['pid']==$cateid){
					$arr[] = $v['id'];	
					//然后依此递归下去，是回去上面从新，找出子栏目，循环出来的值用$arr装起来
					$this->_gerchilrenid($cateres,$v['id']);

				}
			}
		   return $arr;
		}
	
}