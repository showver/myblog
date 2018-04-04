<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	  public function index(){
          $b=M('Blog');
          $R=R('Index/blogmass');
          import('ORG.Util.Page');
          $count=$b->table('my_blog b , my_class c , my_user u ')->where('b.id=u.id and b.c_id=c.c_id')->count();
          $page=new Page($count,5);
          $page->setConfig('theme','%prePage% %linkPage% %nextPage%');
          $show=$page->show();
          //博文显示
          $result=$b->table('my_blog b , my_class c , my_user u ')->where('b.id=u.id and b.c_id=c.c_id')->order('b_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();
           foreach ($result as $key => $value) {
                $b_id=$result[$key]['b_id'];
                $result[$key]['num']=$b->table('my_blog b, my_pinglun p')->where("b.b_id=".$b_id." and b.b_id=p.b_id")->count();
           }
          //var_dump($show);
          $this->assign('page',$show);//分页显示
          $this->assign('blog',$result);//博文显示
          $this->display();
    }
    public function index_login(){
          //博文显示
          $b=M('Blog');
          import('ORG.Util.Page');
          $count=$b->table('my_blog b , my_class c , my_user u ')->where("b.id=u.id and b.c_id=c.c_id and u.id=".session('id'))->count();
          $page=new Page($count,5);
          $page->setConfig('theme','%prePage% %linkPage% %nextPage%');
          $show=$page->show();
          $result=$b->table('my_blog b , my_class c , my_user u ')->where("b.id=u.id and b.c_id=c.c_id and u.id=".session('id'))->select();
           foreach ($result as $key => $value) {
                $b_id=$result[$key]['b_id'];
                $result[$key]['num']=$b->table('my_blog b, my_pinglun p')->where("b.b_id=".$b_id." and b.b_id=p.b_id and u.id=".session('id'))->count();
           }
          $c=M('Class');
          //头部分类显示
          $faclass=$c->where('f_id=0 and id='.session('id'))->select();
          foreach ($faclass as $key => $value) {
               $faclass[$key]['son']=$c->where('f_id='.$faclass[$key]['c_id'].' and id='.session('id'))->select();
          }
          //博文信息统计
          $p=M('Pinglun');
          $b=M('Blog');
          $allmessage['look']=$b->where('id='.session('id'))->sum('look');//访问量
          $allmessage['blog']=$b->where('id='.session('id'))->count();//博文总数
          $allmessage['ping']=$p->where('id='.session('id'))->count();//评论总数
          //var_dump($allmessage['ping']);
       
          //博文热度榜
          $hotblog=$b->order ('look desc')->limit('0,3')->select();//博文热搜榜前三个
          //var_dump($hotblog);
          $this->assign('page',$show);//分页显示
          $this->assign('faclass',$faclass);//头部分类显示
          $this->assign('allmessage',$allmessage);//博文系统综合信息显示
          $this->assign('hotblog',$hotblog);//博文热搜榜前三个
          $this->assign('blog',$result);//博文显示
          $this->assign('faclass',$faclass);//头部分类显示
          $this->display();
    }
    public function blogmass(){
          $c=M('Class');
          //头部分类显示
          $faclass=$c->where('f_id=0')->select();
          foreach ($faclass as $key => $value) {
               $faclass[$key]['son']=$c->where('f_id='.$faclass[$key]['c_id'])->select();
          }
          //var_dump($faclass);
          //博文信息统计
          $p=M('Pinglun');
          $b=M('Blog');
          $allmessage['look']=$b->where('id='.session('id'))->sum('look');//访问量
          $allmessage['blog']=$b->where('id='.session('id'))->count();//博文总数
          $allmessage['ping']=$p->where('id='.session('id'))->count();//评论总数
          //var_dump($allmessage['ping']);
       
          //博文热度榜
          $hotblog=$b->order ('look desc')->limit('0,3')->select();//博文热搜榜前三个
          //var_dump($hotblog);
          $this->assign('faclass',$faclass);//头部分类显示
          $this->assign('allmessage',$allmessage);//博文系统综合信息显示
          $this->assign('hotblog',$hotblog);//博文热搜榜前三个
          //var_dump($result);
    }
    public function headerclassson(){
    	    $R=R('Index/blogmass');
          import('ORG.Util.Page');
		      //博文显示
		      $b=M('Blog');
          $count=$b->table('my_blog b , my_class c , my_user u ')->where('b.id=u.id and b.c_id=c.c_id and c.c_id='.$sonid)->count();
          $page=new Page($count,5);
          $show=$page->show();
		      $sonid=$_GET['sonid'];
          $result=$b->table('my_blog b , my_class c , my_user u ')->where('b.id=u.id and b.c_id=c.c_id and c.c_id='.$sonid)->select();
           foreach ($result as $key => $value) {
           	    $b_id=$result[$key]['b_id'];
           	    $result[$key]['num']=$b->table('my_blog b, my_pinglun p')->where("b.b_id=".$b_id." and b.b_id=p.b_id")->count();
           }
          //博文信息统计
          $this->assign('page',$show);
          $p=M('Pinglun');
          $allmessage['look']=$b->where('id='.session('id'))->sum('look');//访问量
          $allmessage['blog']=$b->where('id='.session('id'))->count();//博文总数
          $allmessage['ping']=$p->where('id='.session('id'))->count();//评论总数
          //var_dump($allmessage['ping']);
       
         //博文热度榜
          $hotblog=$b->order ('look desc')->limit('0,3')->select();//博文热搜榜前三个
         //var_dump($hotblog);
    	    $this->assign('allmessage',$allmessage);//博文系统综合信息显示
    	    $this->assign('hotblog',$hotblog);//博文热搜榜前三个
          //var_dump($result);
          $this->assign('blog',$result);//博文显示
    	    $this->display();
    }
    public function detail(){
    	    $R=R('Index/blogmass');
    	   //博文详细信息查询
    	    $b_id=$_GET['bid'];
    	   //var_dump($b_id);
    	   $b=M('Blog');
		     $blog=$b->table('my_blog b , my_class c , my_user u ')->where('b.id=u.id and b.c_id=c.c_id and b.b_id='.$b_id)->select();
		     $blog[0]['num']=$b->table('my_blog b, my_pinglun p')->where("b.b_id=".$b_id." and b.b_id=p.b_id")->count();
         // var_dump($blog);
         //博文评论信息查询
         if($blog[0]['num']!=0){
           import('ORG.Util.Page');
           $count=$b->table('my_blog b , my_pinglun p , my_user u')->where("b.b_id=".$b_id." and b.b_id=p.b_id and p.id=u.id and p.p_shenhe=1")->count();
        	 $page=new Page($count,3);
           $page->setConfig('theme','%prePage% %linkPage% %nextPage%');
           $show=$page->show();
           $ping=$b->table('my_blog b , my_pinglun p , my_user u')->where("b.b_id=".$b_id." and b.b_id=p.b_id and p.id=u.id and p.p_shenhe=1")->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();
         }
         //var_dump($ping);
         //浏览数自增
         $look=$b->where('b_id='.$b_id)->getfield('look');
         $date['b_id']=intval($b_id);
         if(session('look')=="user".$b_id){
            $date['look']=intval($look);
         }else{
            $date['look']=intval($look)+1;
            session('look',"user".$b_id);
         }
         $r=$b->save($date);
         //var_dump($r);
         //博文信息统计
         $p=M('Pinglun');
         $allmessage['look']=$b->where('id='.session('id'))->sum('look');//访问量
         $allmessage['blog']=$b->where('id='.session('id'))->count();//博文总数
         $allmessage['ping']=$p->where('id='.session('id'))->count();//评论总数
         //var_dump($allmessage['ping']);
        
       
         //博文热度榜
         $hotblog=$b->order ('look desc')->limit('0,3')->select();//博文热搜榜前三个
         //var_dump($hotblog);
    	   $this->assign('blogdetail',$blog);//博文详细信息显示
    	   //$this->assign('session',session('id'));//测试session的值是否存在
    	   $this->assign('blogping',$ping);//该博文评论信息显示
          $this->assign('page',$show);//该博文评论显示
    	   $this->assign('allmessage',$allmessage);//博文系统综合信息显示
    	   $this->assign('hotblog',$hotblog);//博文热搜榜前三个
    	   $this->display();
    }
    public function blogzan(){
         $b_id=$_POST['b_id'];
         $b=M('Blog');
         session('zan',"user".$b_i);
         $zan=$b->where('b_id='.$b_id)->select();
         $date['b_id']=$b_id;
         $date['zan']=$zan[0]['zan']+1;
         $b->save($date);
         $this->ajaxReturn($zan[0]['zan']+1,'json');

    }
    public function blogquzan(){
         $b=M('Blog');
         session('zan',null);
         $b_id=$_POST['b_id'];
         $quzan=$b->where('b_id='.$b_id)->select();
         $date['b_id']=$b_id;
         $date['zan']=$quzan[0]['zan']-1;
         $b->save($date);
         $this->ajaxReturn($quzan[0]['zan']-1,'json');
    }
    public function indexpinglun(){
      	 $date['b_id']=$_POST['b_id'];
      	 $date['id']=session('id');
      	 $date['p_content']=$_POST['p_content'];
      	 $date['p_pubtime']=time();
      	 $p=M('Pinglun');
      	 $p->add($date);
    }
    public function sousuo(){
       $R=R('Index/blogmass');
       $blogkey=$_POST['blogkey'];
       $b=M('Blog');
          $result=$b->where("b_title like '%".$blogkey."%' or b_bar like '%".$blogkey."%'")->select();
           foreach ($result as $key => $value) {
                $b_id=$result[$key]['b_id'];
                $result[$key]['num']=$b->table('my_blog b, my_pinglun p')->where("b.b_id=".$b_id." and b.b_id=p.b_id")->count();
                $result[$key]['b_title']=str_replace($blogkey,"<b><font color='red'>".$blogkey."</font></b>",$result[$key]['b_title']);
                $result[$key]['b_bar']=str_replace($blogkey,"<b><font color='red'>".$blogkey."</font></b>",$result[$key]['b_bar']);
                $result[$key]['user']=$b->table('my_blog b, my_user u')->where("b.b_id=".$b_id." and b.id=u.id")->getfield('user');
                $result[$key]['f_name']=$b->table('my_blog b, my_class c')->where("b.b_id=".$b_id." and b.c_id=c.c_id")->getfield('f_name');
       }
       //var_dump($result);
       $this->assign('blogsou',$result);
       $this->display();
    }
}