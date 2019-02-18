<?php

//首页类
	class IndexController{
        // 导航方法
        public function nav(){
            // include '../public/icheckLogin.php';
            //连接数据库
            $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
            try {
                // 得到PDO对象
                $pdo = new PDO($dsn,'root');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //设置错误
            $pdo->setAttribute(3,1);
            //准备预处理语句
            $sql = "SELECT id,pid,path,name,display FROM type WHERE display=0";
            //将sql语句模板发送预处理
            $stmt = $pdo->prepare($sql);
            //执行sql语句
            $stmt->execute();
            if($stmt->rowCount()){
                //拿出所有值
                $types = $stmt->fetchAll(2);
                //遍历子分类使用的内容
                $pid = $types;
            }else{
                echo '没有内容';
            }
            include './Include/ihead.html'; 
        }
		public function index(){
			// echo '前台首页';
            //引入头部文件 
            $this->nav();
            // 遍历所有商品
            try {
                //准备dsn
                $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                //得到pdo对象
                $pdo = new PDO($dsn,'root');
                // 设置错误
                $pdo->setAttribute(3,1);
                //准备预处理语句
                $sql = "SELECT id,pid,path,name,display FROM type WHERE display=0";
                //将sql语句模板发送预处理
                $stmt = $pdo->prepare($sql);
                //执行sql语句
                $stmt->execute();
                if($stmt->rowCount()){
                    //拿出所有值
                    $types = $stmt->fetchAll(2);
                    //遍历子分类使用的内容
                    $pid = $types;
                }else{
                    echo '没有内容';
                }
                    //判断是否点击了导航
                if(empty($_GET['typeid'])){
                    //将所有商品取出来
                    $sql = "SELECT * FROM goods WHERE `status`=0";
                    // echo $sql;
                    //发送sql模板预处理
                    $stmt = $pdo->prepare($sql);
                 }else{
                    //取出传过来的id下的商品
                    $sql = "SELECT * FROM goods WHERE `status`=0 AND typeid=:typeid";

                    //发送sql模板预处理
                    $stmt = $pdo->prepare($sql);
                    //绑定参数
                    $stmt->bindParam(':typeid',$_GET['typeid']);

                 }
                 $stmt->execute();
                if($stmt->rowCount()){
                    $goods= $stmt->fetchAll(2);

                    // $last_names = array_column($goods, 'name', 'typeid');
                    // var_dump($last_names);
                 }
                 // var_dump($goods);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            include './View/index.html';
            include './Include/foot.html'; 

		}
        //登录页面
        public function login(){
            include './View/login.html';
        }
        //处理登录页面
        public function dologin(){
             $name = $_POST['name'];
            $password = md5($_POST['password']); 

            $data['name']=$name;
            $data['password']=$password;
            //判断是否是管理员
            $data['level']=array();
            //判断是否被禁用
            $data['status']=0;
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
                    $_SESSION['home']=$userinfo[0];
                    $_SESSION["loginKey"]=$_SESSION['home']['id'];
                    // var_dump($_SESSION);
                    echo '<script>alert("登录成功");location="./index.php"</script>';
                    // header('location:index.php?c='.$c.'&'.$a);
                }else{
                    //登录失败
                    echo '<script>alert("用户名或密码不正确");location="./index.php?c=index&a=login"</script>';
                }
        }
         // 退出登录  销毁session
        public function logout(){
            unset($_SESSION['home']);
            echo '<script>alert("退出成功");location="./index.php"</script>';
            }
        // 注册页面
        public function register(){
            // include '../public/icheckLogin.php';
            include './View/register.html';
        }
        //处理注册页面
        public function doreg(){
            include '../public/icheckLogin.php';
            //1.判断密码是否正确
            
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
                echo  '<script>alert("注册成功");location="./index.php?c=index&a=index"</script>';
            }else{

                echo  '<script>alert("注册失败");location="./index.php?c=index&a=register"</script>';
            }
        }
        //商品详情页
        public function xqy(){
             try {
                //准备dsn
                $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                //得到pdo对象
                $pdo = new PDO($dsn,'root');
                // 设置错误
                $pdo->setAttribute(3,1);
                
                $gid = $_GET['gid'];
                //取出传过来的id下的商品
                $sql = "SELECT * FROM goods WHERE `status`=0 AND id ='$gid'";

                //发送sql模板预处理
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount()){
                $goods= $stmt->fetchAll(2);
                 }
                 // var_dump($goods);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            foreach ($goods as $goodslist) {
                
            }
            include './View/xqy.html';
        }


    //二级分类列表
        public function erjilist(){      
            // $_GET['typeid']>11?$_GET['typeid']:$_GET['typeid']='';
            try {
                //准备dsn
                $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                //得到pdo对象
                $pdo = new PDO($dsn,'root');
                // 设置错误
                $pdo->setAttribute(3,1);
                //准备预处理语句
                if ($_GET['typeid']<11){
                    $path = '0,'.$_GET['typeid'].',';
                    $sql = "SELECT id,pid,path,name,display FROM type WHERE display=0 AND path='$path'";
                }else{
                    $typeid = $_GET['typeid'];
                    $sql = "SELECT id,pid,path,name,display FROM type WHERE display=0";
                }
                //将sql语句模板发送预处理
                $stmt = $pdo->prepare($sql);
                //执行sql语句
                $stmt->execute();
                if($stmt->rowCount()){
                    //拿出所有值
                    $types = $stmt->fetchAll(2);
                    //遍历子分类使用的内容
                    $pid = $types;
                    // var_dump($types);

                }else{
                    echo '没有内容';
                }
                // var_dump($types);
                    //判断是否点击了导航
                if($_GET['typeid']<11){
                    //将所有商品取出来
                    
                    $sql = "SELECT * FROM goods WHERE `status`=0";
                    // echo $sql;
                    //发送sql模板预处理
                    $stmt = $pdo->prepare($sql);

                 }else{
                    //取出传过来的id下的商品
                    $typeid = $_GET['typeid'];
                    $sql = "SELECT * FROM goods WHERE `status`=0 AND typeid='$typeid'";

                    //发送sql模板预处理
                    $stmt = $pdo->prepare($sql);

                 }
                    $stmt->execute();
          
                    if($stmt->rowCount()){
                    $goods= $stmt->fetchAll(2);

                 }


            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            // <!-- 遍历一级分类 -->
            foreach($types as $value){ 
            }
            include './Include/head.html';
            include './View/erjilist.html';
            include './Include/foot.html';
        }
        public function allgoods(){
            // 遍历所有商品
            try {
                //准备dsn
                $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                //得到pdo对象
                $pdo = new PDO($dsn,'root');
                // 设置错误
                $pdo->setAttribute(3,1);
                //准备预处理语句
                $sql = "SELECT id,pid,path,name,display FROM type WHERE display=0";
                //将sql语句模板发送预处理
                $stmt = $pdo->prepare($sql);
                //执行sql语句
                $stmt->execute();
                if($stmt->rowCount()){
                    //拿出所有值
                    $types = $stmt->fetchAll(2);
                    //遍历子分类使用的内容
                    $pid = $types;
                }else{
                    echo '没有内容';
                }
                    //判断是否点击了导航
                if(empty($_GET['typeid'])){
                    //将所有商品取出来
                    $sql = "SELECT * FROM goods WHERE `status`=0";
                    // echo $sql;
                    //发送sql模板预处理
                    $stmt = $pdo->prepare($sql);
                 }else{
                    //取出传过来的id下的商品
                    $sql = "SELECT * FROM goods WHERE `status`=0 AND typeid=:typeid";

                    //发送sql模板预处理
                    $stmt = $pdo->prepare($sql);
                    //绑定参数
                    $stmt->bindParam(':typeid',$_GET['typeid']);

                 }
                 $stmt->execute();
                if($stmt->rowCount()){
                    $goods= $stmt->fetchAll(2);

                    // $last_names = array_column($goods, 'name', 'typeid');
                    // var_dump($last_names);
                 }
                 // var_dump($goods);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            include './Include/head.html';
            include './View/allgoods.html';
            include './Include/foot.html';
        }
	}