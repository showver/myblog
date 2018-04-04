<?php
class LoginAction extends Action{
//登录首页
      public function login(){
      	$this->display();
      }
      public function destroysession(){
        if(session('?username')){
          session(null);
          cookie("yh",null);
          cookie("mm",null);
        }
        /*var_dump(cookie("yh"));
        var_dump(session("username"));*/
        $this->display('login');
      }
      //登录验证码
      Public function verify(){
          import('ORG.Util.Image');
          Image::buildImageVerify();
          $this->display();
      }
      //登录用户的用户验证
      public function loginvalid(){
            $user=$_POST['yh'];
            $u=M('user');
            $unum=$u->where("user='".$user."'")->count();
            if($unum==0){
                  echo 'false';
            }else{
                  echo 'true';
            }
      }
      public function loginverify(){
            if($_SESSION['verify'] != md5($_POST['verify'])) {
               echo 'false';
            }else{
               echo 'true';
            }
      }
      //用户登录验证
      public function userlogin(){
            $user=$_POST['yh'];
            $pwd=md5($_POST['mm']."str");//"str"是自定义的字符串
            $remember=$_POST['remember'];
            $u=M('User');
            $res=$u->where("`user`='".$user."' and `pwd`='".$pwd."'")->select();
            if($res){
                  $this->success("登录成功，正在跳转",'__APP__/Index/index_login');
                  session('username',$res[0]['user']);
                  session('id',$res[0]['id']);
                  session('pwd',$res[0]['pwd']);
                  session('QQ',$res[0]['QQ']);
                  session('gro',$res[0]['gro']);
                  if(!empty($remember)){     //如果用户选择了，记录登录状态就把用户名和加了密的密码放到cookie里面 
                    cookie("yh", $res[0]['user'], time()+3600*24*7); 
                    cookie("mm", $_POST['mm'], time()+3600*24*7);
                    //var_dump(cookie("mm"));
                  }  
                  
            }else{
                  $this->error("登录失败,正在转回",'login');
            }
      }


//注册首页
      public function register(){
      	$this->display();
      }
      //判断注册页面的用户名是否存在
      public function validate(){
            $username=$_POST['username'];
            $r=M("User");
            $resuser=$r->where("`user`='".$username."'")->count();
            if($resuser==0){
                  echo 'true';
            }else{
                  echo 'false';
            }
            exit();
            //var_dump($resuser);
      }
      //注册新用户
      public function useradd(){
            if(isset($_POST['registersub'])){
                $date['user']=$_POST['username'];
                $date['pwd']=md5($_POST['pwd']."str");//"str"是自定义的字符串
                $date['QQ']=$_POST['qq'];
                $date['WX']=$_POST['wx'];
                $date['cretime']=time();
                $u=M('User');
                $re=$u->add($date);
                $this->success("注册成功，正在转跳",'login');
            }
      }


//忘记密码首页
      public function forgot(){
      	$this->display();
      }
}