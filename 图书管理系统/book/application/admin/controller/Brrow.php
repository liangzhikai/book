<?php
namespace app\admin\controller;
use app\admin\model\Article  as ArticleModel;
use app\admin\model\Cate  as CateModel;
//继承了common的公共控制器的初始方法
use app\admin\controller\artilcle;
class  Brrow extends Common{
    //ajax,user用户查询书局
        public function userlook(){ 
            if(request()->isAjax()){
            //获取到user的id
            $user = input('user');
            //进行对当前的资料查询
            $useres= db('user')->where(array('id'=>$user))->find();
           return $useres;
          

        }
    }
    //ajax ,book查询数据
        public function booklook(){ 
            if(request()->isAjax()){
            //获取到user的id
            $book = input('book');
            //进行对当前的资料查询
            $bookes= db('article')->where(array('number'=>$book))->find();
           return $bookes;
          

        }
    }
    //ajax，brrow
       public function brrowlook(){ 
            if(request()->isAjax()){
            $map['a.id'] = input('user');
            //进行对当前的资料查询
            $borrowes = db('user')->field('a.*,b.book_number,b.book_title')->alias('a')->join('bk_brrow b','a.id=b.user_id')->where($map)->select();
         
             return json($borrowes);
        }
    }


	public function add(){ 
         if(request()->isPost()){    
        //查询到如果有皆有相同的书本就不能借
        $data = input('post.');     
        $brrowess = db('brrow')->where($data)->find(); 
        //有借了相同的书本不允许借出
    if($brrowess==false){
        if(request()->isPost()){       
            $data = input('post.');
             //查询到如果有皆有相同的书本就不能借
            $brrowess = db('brrow')->where($data)->find(); 
            //给$data增加title字段，book_title
            //查询是否有图书
            $books=db('article')->where(array('number'=>input('book_number')))->where('iy','>',0)->find(); 
            //同时将该图书的现库存量减一 artilce
            $iy =  $books['iy']-1;
            $loan = $books['loan']+1;
            $article =  db('article')->where(array('number'=>input('book_number')))->update([
                'iy'=>$iy,'loan'=>$loan]);         
            //查询是否有读者
            //查询积分低于60的时候不能借书
            $ures=db('user')->where(array('id'=>input('user_id')))->where('credit','>',60)->find();
            //用户信息
            $user=db('user')->where(array('id'=>input('user_id')))->find();
            //借书的同时进行扣除信誉积分，信誉积分低于60不允许借书
            $credit =  $ures['credit']-20;
            $crdres= db('user')->where(array('id'=>input('user_id')))->update([
                'credit'=>$credit]);
            //进行brrow表的插入
            $bookss=db('article')->where(array('number'=>input('book_number')))->find(); 
            $data['book_title'] = $bookss['title'];
            $brrowes = db('brrow')->insert($data);

            //进行对record数据,用于记录数据。0代表借书
            $data['user_name']  = $user['name'];
            $data['book_title'] = $books['title'];
            $data['book_thumb'] = $books['thumb']; 
            $data['type'] = 0;
            $data['time'] = date("Y-m-d");
            dump($data);
            $recordes = db('record')->insert($data);          
             
        if($ures&&$books&&$brrowes&&$crdres&&$article&&$recordes){
                $this->success('更新借书信息成功');
            }else{
                $this->error('更新借书信息失败!,信誉积分不足！');
            }
         }


        }else{
            $this->error('更新借书信息失败!,已借有相同书本！');
        }
          }
    	return view('brrow/add');
    }

    public function bookreturn(){
         if(request()->isPost()){               
            $data = input('post.');
            //给$data增加title字段，book_title
            //查询是否有图书
            $books=db('article')->where(array('number'=>input('book_number')))->where('iy','>',0)->find(); 
            //同时将该图书的现库存量减一 artilce
            $iy =  $books['iy']-1;
            $loan = $books['loan']+1;
            $article =  db('article')->where(array('number'=>input('book_number')))->update([
                'iy'=>$iy,'loan'=>$loan]);         
            //查询是否有读者
            //查询积分低于60的时候不能借书
            $ures=db('user')->where(array('id'=>input('user_id')))->where('credit','>',0)->find();
            //借书的同时进行扣除信誉积分，信誉积分低于60不允许借书
            $credit =  $ures['credit']-20;
            $crdres= db('user')->where(array('id'=>input('user_id')))->update([
                'credit'=>$credit]);
             //还书在brrow表删除其记录
            $bookss=db('article')->where(array('number'=>input('book_number')))->find(); 
            $data['book_title'] = $bookss['title'];
            $brrowes = db('brrow')->where($data)->delete();

            //进行对record数据,用于记录数据。1代表还书
            $data['user_name']  = $ures['name'];
            $data['book_title'] = $books['title'];
            $data['book_thumb'] = $books['thumb']; 
            $data['type'] = 1;
            $data['time'] = date("Y-m-d");
            $recordes = db('record')->insert($data);  
           

            
        if($ures&&$books&&$brrowes&&$crdres&&$article&&$recordes){
                $this->success('更新借书信息成功');
            }else{
                $this->error('更新借书信息失败！');
            }
         }
        return  view('brrow/bookreturn');
    }
}
   
