<?php

//购物车类
	class CartController{
            //添加购物车
        public function addCart(){
            include '../public/icheckLogin.php';
            if(!empty($_GET['gid'])){
                //判断你是否已经添加过这个内容
                if(!empty($_SESSION['cart'][$_GET['gid']])){
                    $_SESSION['cart'][$_GET['gid']]['num']+=1;
                    header('location:index.php');exit;
                }
                  
                  //添加指定商品到购物车
                    try {
                        //连接数据库
                        $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                        // 得到PDO对象
                        $pdo = new PDO($dsn,'root');
                        // 设置错误
                        $pdo->setAttribute(3,1);
                        //准备预处理语句
                        $sql = "SELECT * FROM goods WHERE id=:id";
                        //发送sql语句
                        $stmt = $pdo->prepare($sql);
                        //绑定id
                        $stmt->bindParam(':id',$_GET['gid']);
                        // echo $_GET['gid'];
                        // 执行sql语句
                            $stmt->execute();

                            if($stmt->rowCount()){
                                
                                $row = $stmt->fetch(2);
                                //添加一个购买数量
                                $row['num'] = 1;
                                //将商品添加到购物车
                                $_SESSION['cart'][$_GET['gid']]=$row;   


                                // var_dump($_SESSION);
                                header('location:./index.php');
                            }
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                    // var_dump($_SESSION);
                }else{//你没有指定商品
                echo '<script>alert("请添加指定商品");location="./index.php?c=Index&a=index"</script>';
            }

        }

        // 显示购物
        public function index(){
            include '../public/icheckLogin.php';
            include '../public/icheckLogin.php';
            $total = 0;
            //引入页头
            include './Include/head.html';
            //引入购物车页面
            include './View/cart/showCart.html';
            //引入尾部文件
            include './Include/foot.html';

        }
        //数量加方法
        public function jia(){
            // include '../public/icheckLogin.php';
            var_dump($_GET);
            
            //接受商品id
            $id = $_GET['id'];
            //根据我们传递过来的商品id进行购买数量的累加
            //$_SESSION['cart'][$id]['num']=$_SESSION['cart'][$id]['num']+1;
            $_SESSION['cart'][$id]['num']+=1;
            //记得判断一下你的库存
            header('location:index.php?c=cart&a=index');
        }
            //数量减方法
        public function jian(){
            include '../public/icheckLogin.php';
            // var_dump($_GET);
            
            //接受商品id
            $id = $_GET['id'];
            //根据我们传递过来的商品id进行购买数量的累加
            //$_SESSION['cart'][$id]['num']=$_SESSION['cart'][$id]['num']+1;
            $_SESSION['cart'][$id]['num']-=1;
            if($_SESSION['cart'][$id]['num']<1){
                $_SESSION['cart'][$id]['num']=1;
            //  unset($_SESSION['cart'][$id]);
            }
            
            header('location:index.php?c=cart&a=index');
        }

        //删除某个商品
        public function del(){
            include '../public/icheckLogin.php';
            //var_dump($_GET);
            $id = $_GET['id'];
            unset($_SESSION['cart'][$id]);
            header('location:index.php?c=cart&a=index');
        }
        //清空购物车
        public function delete(){
            include '../public/icheckLogin.php';
            unset($_SESSION['cart']);
            header('location:index.php?c=cart&a=index');
        }
        // 显示结算页面
        public function pay(){
            include '../public/icheckLogin.php';
             //将商品信息赋值给订单变量
            $_SESSION['order'] = $_SESSION['cart'];
            
            $total = 0;
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
            $sql = "SELECT * FROM address LIMIT 1";
            //将sql语句模板发送预处理
            $stmt = $pdo->prepare($sql);
            //执行sql语句
            $stmt->execute();
            if($stmt->rowCount()){
                //拿出所有值
                $address = $stmt->fetchAll(2);
            }else{
                echo '没有内容';
            }
            $_SESSION['address']=$address;
            include './Include/head.html';
            include './View/pay.html';
            include './Include/foot.html';
        }
        //结算页数量加方法
        public function jjia(){
            include '../public/icheckLogin.php';
            
            //接受商品id
            $id = $_GET['id'];
            //根据我们传递过来的商品id进行购买数量的累加
            //$_SESSION['cart'][$id]['num']=$_SESSION['cart'][$id]['num']+1;
            $_SESSION['cart'][$id]['num']+=1;
            //记得判断一下你的库存
            header('location:index.php?c=cart&a=pay');
        }
            //结算页数量减方法
        public function jjian(){
            include '../public/icheckLogin.php';
            //接受商品id
            $id = $_GET['id'];
            //根据我们传递过来的商品id进行购买数量的累加
            //$_SESSION['cart'][$id]['num']=$_SESSION['cart'][$id]['num']+1;
            $_SESSION['cart'][$id]['num']-=1;
            if($_SESSION['cart'][$id]['num']<1){
                $_SESSION['cart'][$id]['num']=1;
            //  unset($_SESSION['cart'][$id]);
            }
            
            header('location:index.php?c=cart&a=pay');
        }
	}