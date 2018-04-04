<?php
class MybackAction extends Action{
      /**后台页面的头部**/
      public function blogmass(){
                 $c=M('Class');
                //头部分类显示
                $faclass=$c->where('f_id=0')->select();
                foreach ($faclass as $key => $value) {
                     $faclass[$key]['son']=$c->where('f_id='.$faclass[$key]['c_id'])->select();
                }
                //var_dump($faclass);
                $this->assign('faclass',$faclass);//头部分类显示

          }

      /***后台页面的分类显示**/
      public function adminclass(){
              $m=M('Class');
              $reclass=$m->where('f_id!=0')->select();
              //var_dump($re);
              $this->assign('blogclass',$reclass);
      }
/****后台首页面处理***********/
      public function back(){
        $R=R('Myback/blogmass');
        //博文信息统计
        $p=M('Pinglun');
        $b=M('Blog');
        $allmessage['look']=$b->where('id='.session('id'))->sum('look');//访问量
        $allmessage['blog']=$b->where('id='.session('id'))->count();//博文总数
        $allmessage['ping']=$p->where('id='.session('id'))->count();//评论总数
        //var_dump($allmessage['ping']);
        $this->assign('allmessage',$allmessage);//博文系统综合信息显示
        $this->display();
      }
/*2、新建博文开始*/
      public function newcreateblog(){
        $R=R('Myback/blogmass');
       /**2.**分类查询显示******/
        $R=R('Myback/adminclass');
        $this->display();
      }
       
      public function createblog(){
       /**2.**新建博文*****/
      	if(isset($_POST['titltsubmit'])){
      	     $date['id']=session('id');
      	     $date['c_id']=$_POST['add_fl'];
      	     $date['b_title']=$_POST['blogtitle'];
      	     $date['b_bar']=$_POST['blogbar'];
      	     $date['b_content']=$_POST['blogcontent'];
      	     $date['b_pubtime']=time();
      	     $date['look']=0;
             $date['zan']=0;
      	     $date['b_type']=$_POST['add_zt'];
      	     //var_dump($_POST['blogcontent']);
      	     $d=M('Blog');
      	     $re=$d->add($date);
      	     $this->success('添加成功，正在跳转','blog_mana');
      	}
      	 
      }

/*3、博文管理开始*/
      public function blog_mana(){
        $R=R('Myback/blogmass');
       /*****3.**博文的查询显示******/
        $b=M('Blog');
      /**3.**分类查询显示******/
        $R=R('Myback/adminclass');

        /******************/
        import('ORG.Util.Page');
        $count=$b->table('my_blog b , my_user u , my_class c')->where('b.c_id=c.c_id and b.id=u.id and u.id='.session('id'))->count();// 查询满足要求的总记录数
        //var_dump($reblog);
        $Page= new Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数                     
        $Page->setConfig('theme','%prePage% %linkPage% %nextPage%');
        $show= $Page->show();// 分页显示输出
        $reblog =$b->table('my_blog b , my_user u , my_class c')->where('b.c_id=c.c_id and b.id=u.id and u.id='.session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        
        //$this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('blogcontent',$reblog);
        //var_dump($show);
        $this->display();
      }

      public function blog_manasousuo(){
       /*3.博文搜索*/
       /**分类显示******/
        $R=R('Myback/adminclass');
      	$titlesou=$_GET['titlesou'];
      	$blogclass=$_GET['blogclass'];
      	$blogtime=$_GET['blogtime'];
      	$now=time();
      	$a=M('Blog');
        import('ORG.Util.Page');
        if($titlesou!=""){
          if($blogclass==0 && $blogtime==0){
            $count=$a->table('my_blog b , my_user u , my_class c')->where("b.b_title like '%".$titlesou."%' and b.c_id=c.c_id and b.id=u.id and u.id=".session('id'))->count();
          }else if($blogclass!=0 && $blogtime==0){
            $count=$a->table('my_blog b , my_user u , my_class c')->where("b.b_title like '%".$titlesou."%' and b.c_id=c.c_id and b.id=u.id and c.c_id=".$blogclass." and u.id=".session('id'))->count();
          }else if($blogclass==0 && $blogtime!=0){
            $count=$a->table('my_blog b , my_user u , my_class c')->where("b.b_title like '%".$titlesou."%' and b.c_id=c.c_id and b.id=u.id and b.b_pubtime between (".$now."-".$blogtime.") and ".$now." and u.id=".session('id'))->count();
          }else if($blogclass!=0 && $blogtime!=0){
            $count=$a->table('my_blog b , my_user u , my_class c')->where("b.b_title like '%".$titlesou."%' and b.c_id=c.c_id and b.id=u.id  and c.c_id=".$blogclass." and b.b_pubtime between (".$now."-".$blogtime.") and ".$now."and u.id=".session('id'))->count();
          }
        }else if($titlesou==""){
          if($blogclass==0 && $blogtime==0){
            $count=$a->table('my_blog b , my_user u , my_class c')->where("b.c_id=c.c_id and b.id=u.id and u.id=".session('id'))->count();
          }else if($blogclass!=0 && $blogtime==0){
            $count=$a->table('my_blog b , my_user u , my_class c')->where("b.c_id=c.c_id and b.id=u.id and c.c_id=".$blogclass." and u.id=".session('id'))->count();
          }else if($blogclass==0 && $blogtime!=0){
            $count=$a->table('my_blog b , my_user u , my_class c')->where("b.c_id=c.c_id and b.id=u.id and b.b_pubtime between (".$now."-".$blogtime.") and ".$now." and u.id=".session('id'))->count();
          }else if($blogclass!=0 && $blogtime!=0){
            $count=$a->table('my_blog b , my_user u , my_class c')->where("b.c_id=c.c_id and b.id=u.id  and c.c_id=".$blogclass." and b.b_pubtime between (".$now."-".$blogtime.") and ".$now." and u.id=".session('id'))->count();
          }
        }

        $Page=new Page($count,4);
        $Page->setconfig('theme','%prePage% %linkPage% %nextPage% ');
		    $show=$Page->show();
      	if($titlesou!=""){
      		if($blogclass==0 && $blogtime==0){
      			$sou=$a->table('my_blog b , my_user u , my_class c')->where("b.b_title like '%".$titlesou."%' and b.c_id=c.c_id and b.id=u.id and u.id=".session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      		}else if($blogclass!=0 && $blogtime==0){
      			$sou=$a->table('my_blog b , my_user u , my_class c')->where("b.b_title like '%".$titlesou."%' and b.c_id=c.c_id and b.id=u.id and c.c_id=".$blogclass." and u.id=".session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      		}else if($blogclass==0 && $blogtime!=0){
      			$sou=$a->table('my_blog b , my_user u , my_class c')->where("b.b_title like '%".$titlesou."%' and b.c_id=c.c_id and b.id=u.id and b.b_pubtime between (".$now."-".$blogtime.") and ".$now." and u.id=".session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      		}else if($blogclass!=0 && $blogtime!=0){
      			$sou=$a->table('my_blog b , my_user u , my_class c')->where("b.b_title like '%".$titlesou."%' and b.c_id=c.c_id and b.id=u.id  and c.c_id=".$blogclass." and b.b_pubtime between (".$now."-".$blogtime.") and ".$now." and u.id=".session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      		}
          //关键词高光
          foreach ($sou as $key => $value) {
           $sou[$key]['b_title']=str_replace($titlesou,"<b><font color='red'>".$titlesou."</font></b>",$sou[$key]['b_title']);
           //var_dump($sou[$key]['b_title']);
           }
      	}else if($titlesou==""){
      		if($blogclass==0 && $blogtime==0){
      			$sou=$a->table('my_blog b , my_user u , my_class c')->where("b.c_id=c.c_id and b.id=u.id and u.id=".session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      		}else if($blogclass!=0 && $blogtime==0){
      			$sou=$a->table('my_blog b , my_user u , my_class c')->where("b.c_id=c.c_id and b.id=u.id and c.c_id=".$blogclass." and u.id=".session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      		}else if($blogclass==0 && $blogtime!=0){
      			$sou=$a->table('my_blog b , my_user u , my_class c')->where("b.c_id=c.c_id and b.id=u.id and b.b_pubtime between (".$now."-".$blogtime.") and ".$now." and u.id=".session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      		}else if($blogclass!=0 && $blogtime!=0){
      			$sou=$a->table('my_blog b , my_user u , my_class c')->where("b.c_id=c.c_id and b.id=u.id  and c.c_id=".$blogclass." and b.b_pubtime between (".$now."-".$blogtime.") and ".$now." and u.id=".session('id'))->order('b_pubtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      		}
        }
         //var_dump($show);
        $this->assign('sou',$sou);
        $this->assign('page',$show);
      	$this->display();

      }
      public function blogmodel(){
        /*3、向编辑模态框中传值*/
        $b_id=$_POST['b_id'];
        $b=M("Blog");
        $blog=$b->where('b_id='.$b_id)->select();
        $this->ajaxReturn($blog,'json');
      }
      public function blogupdate(){
       /*3、博文编辑更新数据开始*/
      	$blog['b_id']=$_POST['blogid'];
      	$blog['b_title']=$_POST['newtitle'];
      	$blog['c_id']=$_POST['blogselect'];
        $blog['b_content']=$_POST['blogkindeditor'];
        $blog['b_newtime']=time();
      	$b=M("Blog");
      	$b->save($blog);
      }
      public function blogdel(){
       /*3、博文删除单条数据开始*/
      	$blogid=$_POST['blogid'];
      	$p=M('Pinglun');
        $count=$p->where('b_id='.$blogid)->count();
        if($count!=0){
          $p->where("b_id=".$blogid)->delete();
        }
          $b=M("Blog");
          $b->where('b_id='.$blogid)->delete();
      }
      public function blogdelall(){
       /*3、博文删除所有数据开始*/
      	$blogidarr=$_POST['blogidarr'];
      	$date['b_id']=array('in',$blogidarr);
      	$b=M('Blog');
      	$con=$b->where($date)->delete();
        $p=M('Pinglun');
        $count=$p->where($date)->select();
        if($count!=0){
          $p->where($date)->delete();
        }
      }

/*5、博文评论管理开始*/
      public function pinglun_mana(){
        $R=R('Myback/blogmass');
       /*****5.评论已审核管理的数据查询开始*****/ 
        $p=M('Pinglun');
        import('ORG.Util.Page');
        $count=$p->table('my_pinglun p , my_user u , my_blog b')->where('p.b_id=b.b_id  and p.p_shenhe=1 and b.id='.session('id')." and b.id=u.id" )->count();
        $page=new Page($count,4);
        $page->setconfig('theme','%prePage% %linkPage% %nextPage% ');
        $show=$page->show();
        $reping=$p->table('my_pinglun p , my_user u , my_blog b')->where('p.b_id=b.b_id  and p.p_shenhe=1 and b.id='.session('id')." and b.id=u.id" )->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();
        //var_dump($reping);
        $this->assign('page',$show);
        $this->assign('reping',$reping);
        $this->display();
      }
      public function blogpinglunkey(){
       /*****5、博文已审核关键字模糊查询********/
        $p=M('Pinglun');
        $pingkey=$_GET['pinglunkey'];
        $pingluntime=$_GET['pingluntime'];
        $nowtime=time();
        import('ORG.Util.Page');
        if($pingkey==""){
          //$pingsou=0;
          if($pingluntime==0){
            $count=$p->table('my_pinglun p , my_user u , my_blog b')->where('p.b_id=b.b_id and p.p_shenhe=1 and b.id='.session('id')." and b.id=u.id" )->count();
          }else{
            $count=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=1 and b.id=".session('id')." and b.id=u.id and p.p_pubtime between (".$nowtime."-".$pingluntime.") and ".$nowtime)->count();  
          }
        }else if($pingkey!=""){
          //$pingsou=1;
          if($pingluntime==0){
            $count=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=1 and b.id=".session('id')." and b.id=u.id and p.p_content like '%".$pingkey."%'")->count();
          }else{
            $count=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=1 and b.id=".session('id')." and b.id=u.id and p.p_content like '%".$pingkey."%' and p.p_pubtime between (".$nowtime."-".$pingluntime.") and ".$nowtime)->count();  
          }
        }
        $page=new Page($count,4);
        $page->setConfig('theme','%prePage% %linkPage% %nextPage% ');
        $show=$page->show();
        if($pingkey==""){
          //$pingsou=0;
          if($pingluntime==0){
            $pingsou=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=1 and b.id=".session('id')." and b.id=u.id")->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();
          }else{
            $pingsou=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=1 and b.id=".session('id')." and b.id=u.id and p.p_pubtime between (".$nowtime."-".$pingluntime.") and ".$nowtime)->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();  
          }
        }else if($pingkey!=""){
          //$pingsou=1;
          if($pingluntime==0){
            $pingsou=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=1 and b.id=".session('id')." and b.id=u.id and p.p_content like '%".$pingkey."%'")->order('p_pubtime desc')->limit($page->firstRow.",".$page->listRows)->select();
          }else{
            $pingsou=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=1 and b.id=".session('id')." and b.id=u.id and p.p_content like '%".$pingkey."%' and p.p_pubtime between (".$nowtime."-".$pingluntime.") and ".$nowtime)->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();  
          }
          foreach($pingsou as $key=>$value){
            $pingsou[$key]['p_content']=str_replace($pingkey,"<b><font color='red'>".$pingkey."</font></b>",$pingsou[$key]['p_content']);
          }
        }
        $this->assign('page',$show);
        $this->assign('pingsou',$pingsou);
        $this->display();
      }
      public function noshenhe(){
        $R=R('Myback/blogmass');
       /*****5、博文待审核评论数据查询********/
      	$s=M('Pinglun');
        import('ORG.Util.Page');
        $count=$s->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id")->count();
        $page=new Page($count,4);
        $page->setConfig('theme','%prePage% %linkPage% %nextPage% ');
        $show=$page->show();
      	$reshen=$s->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id")->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();
      	//var_dump(session('id'));
      	$this->assign('reshen',$reshen);
        $this->assign('page',$show);
      	$this->display();
      }
      public function blognoshenkey(){
       /*****5、博文待审核关键字模糊查询********/
        $p=M('Pinglun');
        $pingkey=$_GET['nopinglunkey'];
        $pingluntime=$_GET['nopingluntime'];
        $nowtime=time();
        import('ORG.Util.Page');
        if($pingkey==""){
          //$nopingsou=0;
          if($pingluntime==0){
             $count=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id")->count();
          }else{
             $count=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id and p.p_pubtime between (".$nowtime."-".$pingluntime.") and ".$nowtime)->count();  
          }
        }else if($pingkey!=""){
          //$nopingsou=1;
          if($pingluntime==0){
             $count=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.p_content like '%".$pingkey."%' and p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id")->count();
         }else{
             $count=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id and p.p_content like '%".$pingkey."%' and p.p_pubtime between (".$nowtime."-".$pingluntime.") and ".$nowtime)->count();  
         }
        }
        $page=new Page($count,4);
        $page->setConfig('theme','%prePage% %linkPage% %nextPage% ');
        $show=$page->show();
        if($pingkey==""){
          //$nopingsou=0;
          if($pingluntime==0){
          $nopingsou=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id")->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();
          }else{
            $nopingsou=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id and p.p_pubtime between (".$nowtime."-".$pingluntime.") and ".$nowtime)->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();  
          }
        }else if($pingkey!=""){
          //$nopingsou=1;
          if($pingluntime==0){
          $nopingsou=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.p_content like '%".$pingkey."%' and p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id")->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();
          }else{
            $nopingsou=$p->table('my_pinglun p , my_user u , my_blog b')->where("p.b_id=b.b_id and p.p_shenhe=0 and b.id=".session('id')." and b.id=u.id and p.p_content like '%".$pingkey."%' and p.p_pubtime between (".$nowtime."-".$pingluntime.") and ".$nowtime)->order('p_pubtime desc')->limit($page->firstRow.','.$page->listRows)->select();  
          }
          foreach($nopingsou as $key=>$value){
            $nopingsou[$key]['p_content']=str_replace($pingkey,"<b><font color='red'>".$pingkey."</font></b>",$nopingsou[$key]['p_content']);
            //var_dump($nopingsou[$key]['p_content']);
          }
        }

        $this->assign('nopingsou',$nopingsou);
        $this->assign('page',$show);
        $this->display();
      }
      public function p_zhuangtai(){
       /*****5、博文评论状态编辑********/
        $z=M('Pinglun');
        $date['p_id']=$_POST['p_id'];
        $date['p_zhuangtai']=$_POST['p_zhuangtai'];
        $z->save($date);
      } 
      public function comm_check(){
        $R=R('Myback/blogmass');
       /*****5、博文评论详情数据查看********/
        $l=M('Pinglun');
        $p_id=$_GET['p_id'];
        $re=$l->table('my_pinglun p , my_user u')->where("p.id=u.id and p.p_id=".$p_id)->select();
        $this->assign('comm',$re);
        //var_dump($re);
        $this->display();
      }
      public function pinglundel(){
       /*****5、博文单条数据删除********/
  	    $p_id=$_POST['p_id'];
  	    $p=M('Pinglun');
  	    $p->where("p_id=".$p_id)->delete();
  	   // $this->ajaxReturn($p_id,'json');
      }
      public function pinglundelarr(){
       /*****5、博文评论批量删除********/
      	$pidarr=$_POST['pidarr'];
      	$p=M('Pinglun');
      	$date['p_id']=array('in',$pidarr);
      	$p->where($date)->delete();
      }
      public function pinglunshenhearr(){
       /*****5、博文评论批量审核********/
        $p_shen_arr=$_POST['p_shen_arr'];
        $p=M('Pinglun');
        $date['p_id']=array('in',$p_shen_arr);
        $date['p_shenhe']=1;
        $p->save($date);
      }
/*6.分类管理开始*/
      public function class_mana(){
        $R=R('Myback/blogmass');
       /*****6.分类管理的添加分类中父类的查询开始*****/
        $m=M('Class');

        /**********多级分类的代码************/
        //concat()连接字符串的函数
/*        $res=$m->field("*,concat(path, ',',f_id) as paths")->order('paths')->select();
        foreach ($res as $k => $v) {
        //重命名，str_repeact()重复“**”多少次，并且有明显的类级别
           $res[$k]['f_name']=str_repeat("|--", $v['level']).$v['f_name'];
        }
        //var_dump($res);*/


        $res=$m->where('f_id=0')->select();
        $this->assign('addfuclass',$res);
       /*****6.分类管理的添加类别的数据查询开始*****/ 
        import('ORG.Util.Page');
        $count=$m->count();
        $page=new Page($count,4);
        $page->setConfig('theme','%prePage% %linkPage% %nextPage% ');
        $show=$page->show();
        $addres=$m->where('id='.session('id'))->order('f_id')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('addres',$addres);
        $this->assign('page',$show);
        $this->display();
      }
      public function addClass(){
       /*6.添加分类的函数*/
        $date['id']=session('id');
        $date['f_name']=$_POST['addfuname'];
        $date['f_id']=$_POST['addfuid'];
      //当分类为一级分类
        if( $date['f_id']==0){
          $m=M('Class');
          $date['path']=0;
          $date['level']=1;
          $date['add_time']=time();
          $re=$m->add($date);
          $add['c_id']=$re;
          $add['path']=$date['f_id'].",".$add['c_id'];
          $m->save($add);
        }else{
        //当分类为二级以下分类
          $m=M('Class');
          $path=$m->field("path")->where("c_id=".$date['f_id'])->find();
          $date['path']=$path['path'];
          $date['level']=substr_count($date['path'], ',');
          $date['add_time']=time();
          $re=$m->add($date);
          $add['c_id']=$re;
          $add['path']=$date['path'].",".$add['c_id'];
          $add['level']=substr_count($add['path'],',');
          $m->save($add);
          
        }
          $res=$m->where("c_id=".$add['c_id'])->select();
          $this->ajaxReturn($res,'json');
      }
      public function classedit(){
       /*6.分类编辑的数据传入*/
        $m=M('Class');
        $c_id=$_POST['c_id'];
        $classedit=$m->where('c_id='.$c_id)->find();
        $this->ajaxReturn($classedit,'json');
      }
      public function classup(){
       /*6.分类编辑的数据*/
      	$m=M('Class');
      	$c_id=$_POST['c_id'];
      	$f_id=$_POST['f_id'];
      	$f_name=$_POST['f_name'];
      	$path=$_POST['path'];
      	$date['c_id']=$c_id;
      	$date['f_id']=$f_id;
      	$date['f_name']=$f_name;
      	$date['path']=$path;
      	$date['level']=substr_count($path,',');        	
      	$date['add_time']=time();
      	$classup=$m->save($date);  
      }
      /*6.分类数据删除*/
      public function classdel(){
        $c_id=$_POST['c_id'];
        $c=M('Class');
        $c->where('c_id='.$c_id)->delete();
      }
/*8.用户管理开始*/
      public function user_mana(){
        $R=R('Myback/blogmass');
       /*****8.用户管理的页码数据开始******/
        if(session('gro')!=0){
             $m=M('User');
             $result=$m->table('my_user u,my_gro g')->where('u.gro=g.uid and u.id='.session('id'))->select();
             //arr是页码数据查询结果在前台显示
             $this->assign("arr",$result);
         /*****8.用户管理的用户级别查询的开始*****/
             $gro=M('Gro');
             $sel_gro=$gro->select();
             //dump($sel_gro);
             $this->assign("sel_gro",$sel_gro);
             $this->display();
        }else{
          if($_GET['page']==""){
            $_GET['page']=1;
        }
          if(isset($_GET['page'])){
            //获取的页码
             $page=$_GET['page'];
             $m=M('User');
             //页面显示条数
             $page_size=4;
             //页面总数
             $count=$m->count();
             //页码数
             $massage_page=ceil($count/$page_size);
             $offset=($page-1)*$page_size;
             //一个页码的数据查询
             $result=$m->table('my_user a,my_gro b')->where('a.gro=b.uid')->limit($offset,$page_size)->order('a.id desc')->select();
             //arr是页码数据查询结果在前台显示
             $this->assign("arr",$result);
             //massage_page是页码数在前台显示
             $this->assign("massage_page",$massage_page);
                   //var_dump($result);
          }
         /*****8.用户管理的用户级别查询的开始*****/
             $gro=M('Gro');
             $sel_gro=$gro->select();
              //dump($sel_gro);
             $this->assign("sel_gro",$sel_gro);
             $this->display();
          }
      }
		  public function up_page(){
       /*8.前台页码传值过来*/
/*	      if($_GET['page']==""){
				$_GET['page']=1;
			  }
			//is_numeric判断是不是数字或者数字字符串
  			if(is_numeric($_GET['page'])){
  			//获取的页码
  			   $page=$_GET['page'];
  			   $m=M('User');
  			//页面显示条数
  			   $page_size=2;
  			//页面总数
  			   $count=$m->count();
  			   $massage_page=ceil($count/$page_size);
  			//页数
  			   $offset=($page-1)*$page_size;
  			   $result=$m->table('my_user a,my_gro b')->where('a.gro=b.uid')->limit($offset,$page_size)->order('a.id desc')->select();
  			   $this->assign("massage_page",$massage_page);
  			   $this->assign("page",$page);
  			   $this->ajaxReturn($result,'json');        
  			}*/
	  	}
		  /*****页码后台数据结束*******/ 
  		public function del(){
       /******8.用户管理的删除********/
  			$id=$_POST['id'];
  			//dump($id);
  			$m=M('User');
  			$res=$m->where('id='.$id)->delete();
  		}
  		public function update(){
  		 /******8.用户管理的编辑*********/
        $id=$_POST['idd'];
           $up_uid=$_POST['stunoo'];
           $up_pwd=$_POST['passs'];
           $up_user=$_POST['namee'];
           $user=M('User');
           $us['id']=$id;
           $us['user']=$up_user;
           $us['pwd']=md5($up_pwd."str");
           $us['gro']=$up_uid;
           $us['cretime']=time();
           $user->save($us);
           $D=M('Gro');
           $gro_name=$D->where('uid='.$up_uid)->getfield('name');
           $usup['id']=$id;
           $usup['user']=$up_user;
           $usup['pwd']=md5($up_pwd."str");
           $usup['name']=$gro_name;
           $usup['cretime']=time();
        $json=json_encode($usup);
        echo $json; 
  		}
		public function useradd(){
     /***8.用户管理的添加用户****/
			$user=$_POST['add_user'];
			$pwd=$_POST['add_pwd'];
			$gid=$_POST['sel_gro'];
			$time=time();
			$m=M('User');
			$add['user']=$user;
			$add['pwd']=md5($pwd."str");
			$add['cretime']=$time;
			$add['gro']=$gid;
			$m->add($add);
		}
}
