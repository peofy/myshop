<?php
    //用户模块
        session_start();  
    class UserController{
        //显示列表页面
        public function index(){
           // echo '用户列表页 ';
           // 接收搜索条件
           // var_dump($_GET);
           include '../public/checkLogin.php';
            if(empty($_GET['name'])){
                $data = array();
            }else{
                $data['name'] = array('like',$_GET['name']);
            }
            //将数据遍历到表格中
           $user = new Model('user');
           $total = $user->where($data)->count();
           //得到分页类
           $page = new Page($total,3);
           $userlist = $user->where($data)->limit($page->limit)->select(); 
           $i = 1;
           // var_dump($userlist);
           include './View/user/index.html';
        }
        //添加用户
        public function add(){
            // echo '用户添加液';
            include '../public/checkLogin.php';
            include './View/user/add.html';
        }
        //添加用户处理方法
        public function doadd(){
            //1.判断密码是否正确
            include '../public/checkLogin.php';
            if($_POST['password'] != $_POST['repassword']){
                echo '两次密码不一致，<a href="./index.php?c=user&a=add">返回重写</a>';
            }
            //2.删除多余repassword
            unset($_POST['repassword']);
            //3.给password加密
            $_POST['password'] = md5($_POST['password']);
            //4.添加缺少的两个字段
            $_POST['status'] = 0;
            $_POST['addtime'] = time();
            //得到对象
            $user = new Model('user');
            $bool=$user->add($_POST);

            if($bool){
                echo  '<script>alert("添加成功");location="./index.php?c=user&a=index"</script>';
            }else{

                echo  '<script>alert("添加失败");location="./index.php?c=user&a=add"</script>';
            }
        }
        //删除方法
        public  function del(){
            // var_dump($_GET);
            include '../public/checkLogin.php';
            $id = $_GET['id'];
            $user = new Model('user');
            if($user->del($id)){
                header('location:index.php?c=user&a=index');
            }else{
                header('location:index.php?c=user&a=index');
            }
        }
        //开启 已锁定 方法
        public function status(){
            include '../public/checkLogin.php';
            // var_dump($_GET);
            //修改数据
            $data =array();
            $data['id']=$_GET['id'];
            $data['status']=$_GET['status'];
            //链接数据库
            $user = new Model('user');
            //修改数据
            if($user->update($data)){
                header('location:index.php?c=user&a=index');
            }else{
                header('location:index.php?c=user&a=index');
            }
        }
        //编辑
        public function edit(){
            include '../public/checkLogin.php';            
            $user = new Model('user');
            $userlist = $user->find($_GET['id']);
            // var_dump($userlist);

           include './View/user/edit.html';

        }
        //处理编辑
        public function doedit(){
            include '../public/checkLogin.php';
           $user = new Model('user');
            // var_dump($_POST);
            $bool=$user->update($_POST);
            if($bool){
                echo '<script>alert("修改成功");location="./index.php?c=user&a=index";</script>';
            }else{
                echo '<script>alert("未修改任何数据");location="./index.php?c=user&a=index";</script>';
            }
        }
        // 引入登录页
        public function login(){

           include './View/user/login.html';
        }
        //处理登录验证用户名密码
        public function dologin(){
            // include '../public/checkLogin.php';
            $name = $_POST['name'];
            $password = md5($_POST['password']); 

            $data['name']=$name;
            $data['password']=$password;
            //判断是否是管理员
            $data['level']=array('gt',1);
            //判断是否被禁用
            $data['status']=0;
            // var_dump($data);
            //查询数据库
                $user = new Model('user');
                $userinfo = $user->where($data)->select();
                // var_dump($userinfo);
                if($userinfo){
                    //登录成功
                    //如果登录成功我们需要将登录成功的这个数组存入到session中但是不要存密码
                    //var_dump($userinfo);
                    //除掉密码
                    unset($userinfo[0]['password']);
                    //var_dump($userinfo);
                    //将没有面的数组放入到session中
                    $_SESSION['admin']=$userinfo[0];
                    $_SESSION["loginKey"]=$_SESSION['admin']['id'];
                    // var_dump($_SESSION);
                    echo '<script>alert("登录成功");location="./index.php"</script>';
                    // header('location:index.php');
                }else{
                    //登录失败
                    echo '<script>alert("用户名或密码不正确");location="./index.php?c=user&a=login"</script>';
                }
        }
        // 退出登录  销毁session
        public function logout(){
            unset($_SESSION['admin']);
             include './View/user/login.html';

        }




        // 用户详情页方法
        public function userinfo(){
            include '../public/checkLogin.php';
            // echo '用户详情页';
            // var_dump($_GET);
            //通过用户id查找user_info是否有数据
            //
            $info = new Model('user_info');
            $data['uid'] = $_GET['id'];
            // var_dump($data);
            $result = $info->where($data)->find();
            
            //加载详情页面显示
            include './View/user/userinfo.html';
        }
        
        public function douserinfo(){
            include '../public/checkLogin.php';          
            //判断$_POST[uid]是否为空，如果有数据是修改，如果没有数据是添加
            if($_POST['uid'] == ''){
                //添加操作
                 // var_dump($_POST);
                 // var_dump($_FILES);
                 // 文件上传
                 $upload = new Uploads('image');
                 //允许上传的类型
                 $upload->typelist=array('image/jpeg','image/jpg','image/jpg','image/png');
                 //图片保存的路径
                 $upload->path ='../public/uploads/';
                 //执行文件上传
                 $bool = $upload->upload();
                 if(!$bool){
                    echo '<script>alert("上传失败");location="./index.php?c=user&a=index";</script>';
                 }
                 //图片上传成功后将图片名保存到$_POST中
                 $_POST['image'] = $upload->savename;

                 //将用户传过来的id添加到$_POST
                 $_POST['uid'] = $_GET['id'];
                 // var_dump($_POST);
                 // 进行添加操作
                 $info = new Model('user_info');
                 $result = $info->add($_POST);
                 if($result){
                    echo '<script>alert("添加成功");location="./index.php?c=user&a=index";</script>';
                 }else{
                    echo '<script>alert("添加失败");location="./index.php?c=user&a=index";</script>';
                 }
            }else{
                // 修改操作
                //判断图片是否被修改如果没有修改不用删除图片，如果修改要把 旧图片删除
                // echo $_FILES['image']['name'];
                if ($_FILES['image']['name']== ''){
                    // echo '不修改图片';
                    // var_dump($_POST);
                    $info = new Model('user_info');
                    $data['uid'] = $_POST['uid'];
                    $bool = $info->where($data)->update($_POST);
                    $url = './index.php?c=user&a=userinfo&id='.$_POST['uid'];
                    if($bool){
                        echo '<script>alert("修改成功");location="./index.php?c=user&a=index";</script>';
                    }else{
                        
                        header('location:'.$url);
                    }
                }else{
                    // echo '修改图片';
                    // 取出之前的图片
                    $info = new Model('user_info');
                    $data['uid'] = $_POST['uid'];
                    $result = $info->where($data)->find();
                    // var_dump($result);
                    // 得到旧图片的名字
                    $oldimgname = $result['image'];
                    //将新图片放到老图片的位置
                    // 文件上传
                     $upload = new Uploads('image');
                     //允许上传的类型
                     $upload->typelist=array('image/jpeg','image/jpg','image/jpg','image/png');
                     //图片保存的路径
                     $upload->path ='../public/uploads/';
                     //执行文件上传
                     $bool = $upload->upload();
                     if(!$bool){
                        echo '上传失败';exit;
                     }
                     //图片上传成功后将图片名保存到$_POST中
                     $_POST['image'] = $upload->savename;
                     $data['uid'] = $_POST['uid'];
                     //执行修改操作
                     $result = $info->where($data)->update($_POST);
                     $url = './index.php?c=user&a=userinfo&id='.$_POST['uid'];
                     if($result){
                        //删除旧图片
                        @unlink('../public/uploads/'.$oldimgname);
                        echo '<script>alert("修改成功");location="./index.php?c=user&a=index";</script>';
                     }else{
                        
                        header('location:'.$url);
                     }
            }
        }
    }
}