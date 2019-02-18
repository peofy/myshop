<?php

//订单类类
	class OrderController{
        //显示订单页
        public function order(){
            include '../public/icheckLogin.php';
            // 查询所有订单
             try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句
                    $sql = "SELECT * FROM orders WHERE uid={$_SESSION['home']['id']}";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    if($stmt->rowCount()){
                    //拿出所有值
                        $allorders = $stmt->fetchAll(2);
                        // var_dump($allorders);
                        // var_dump();
                    }
                 } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                //查询status为0时的订单即新订单
                 try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句
                    $sql = "SELECT * FROM orders WHERE status=0 AND uid={$_SESSION['home']['id']}";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    if($stmt->rowCount()){
                    //拿出所有值
                        $status0 = $stmt->fetchAll(2);
                        // var_dump($allorders);
                    }
                 } catch (PDOException $e) {
                        echo $e->getMessage();
                    }

                //查询status为1时的订单即已发货
                 try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句
                    $sql = "SELECT * FROM orders WHERE status=1 AND uid={$_SESSION['home']['id']}";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    if($stmt->rowCount()){
                    //拿出所有值
                        $status1 = $stmt->fetchAll(2);
                        // var_dump($allorders);
                    }
                 } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                //查询status为2时的订单即已发货
                 try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句
                    $sql = "SELECT * FROM orders WHERE status=2 AND uid={$_SESSION['home']['id']}";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    if($stmt->rowCount()){
                    //拿出所有值
                        $status2 = $stmt->fetchAll(2);
                        // var_dump($allorders);
                    }
                 } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
            include './View/order.html';

        }
        //付款成功页
        public function success(){
           include '../public/icheckLogin.php';
            //清空购物车
            unset( $_SESSION['cart']);

            //将订单信息加入订单表
            $uid =  $_SESSION['home']['id'];
            $linkname = $_SESSION['address'][0]['name'];
            $address = $_SESSION['address'][0]['address'];
            $tel = $_SESSION['address'][0]['tel'];
            $total = $_SESSION['total']['total'];
                try {
                        //连接数据库
                        $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                        // 得到PDO对象
                        $pdo = new PDO($dsn,'root');
                        // 设置错误
                        $pdo->setAttribute(3,1);
                        //准备预处理语句
                        $sql = "INSERT INTO orders VALUES(NULL,{$uid},'{$linkname}','{$address}',{$tel},'000000',{$total},0)"; 
                        //发送sql语句
                        $stmt = $pdo->prepare($sql);
                        // 执行sql语句
                            $stmt->execute();
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }

            // 根据购买商品数量减少对象库存
            foreach($_SESSION['order'] as $value){

           
            try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备预处理语句
                    $sql = "UPDATE goods SET store=store-{$value['num']},sales=sales+{$value['num']} WHERE id=:id"; 
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    //绑定id
                    $stmt->bindParam(':id',$value['id']);
                    // 执行sql语句
                        $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
             }
             //将商品添加到订单详情表
             
             try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //查询orders表里最大id就是当前订单详情
                    //准备sql语句
                    $sql = "SELECT MAX(id) FROM orders";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    if($stmt->rowCount()){
                    //拿出所有值
                        $oids = $stmt->fetch(2);
                        // var_dump($oids);
                        $oid = $oids['MAX(id)'];
                    }else{
                        echo '没有内容';
                    }

                    foreach($_SESSION['order'] as $value){
                        // var_dump($value);
                    $gid = $value['id'];
                    $gname = $value['name'];
                    $price = $value['price'];
                    $gnum = $value['num'];
                    $pic = $value['pic'];
                    //准备预处理语句
                    $sql = "INSERT INTO order_info VALUES(NULL,{$oid},{$gid},'{$gname}',{$price},{$gnum},'{$pic}')"; 
                    // echo $sql;
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            
            include './Include/head.html';
            include './View/success.html';
            include './Include/foot.html';
        }
       // 订单详情
       public function orderinfo(){
            include '../public/icheckLogin.php';
            //遍历订单详情
             try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句 根据订单id查询订单状态
                    $sql = "SELECT * FROM orders WHERE id='{$_GET['oid']}'";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    if($stmt->rowCount()){
                    //拿出所有值
                    
                        $ordersid = $stmt->fetchAll(2);
                        // var_dump($ordersid);
                    }else{
                        echo '没有内容';
                    }



                    //准备sql语句查询订单详情
                    $sql = "SELECT * FROM order_info WHERE oid='{$_GET['oid']}'";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    if($stmt->rowCount()){
                    //拿出所有值
                    
                        $orderinfo = $stmt->fetchAll(2);
                        // var_dump($orderinfo);
                    }else{
                        echo '没有内容';
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            // include './Include/head.html';
            include './View/orderinfo.html';
            // include './Include/foot.html';
       }
       //交易操作
       public function dojiaoyi(){
        var_dump($_GET);
        $url = 'index.php?c=order&a=orderinfo&oid='.$_GET['id'];
        switch ($_GET['status']){
            case 0:
                header('location: '.$url);
                break;
            case 1:
                try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句 根据订单id查询订单状态
                    $sql = "UPDATE  orders SET status= 2 WHERE id='{$_GET['id']}'";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                header('location: '.$url);
                break;
            case 2:
                try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句 根据订单id查询订单状态
                    $sql = "UPDATE  orders SET status= 3  WHERE id='{$_GET['id']}'";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                header('location: '.$url);
                break;
            case 3:
                try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句 根据订单id查询订单状态
                    $sql = "UPDATE  orders SET status= 4 WHERE id='{$_GET['id']}'";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                header('location: '.$url);
                break;
            case 4:
                header('location: '.$url);
                break;
        }
       }
       //前台删除订单
       public function del(){
        include '../public/icheckLogin.php';
        try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句 根据订单id查询订单状态
                    $sql = "DELETE FROM orders WHERE id={$_GET['oid']}";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                    if($stmt->rowCount()){
                    //返回订单页
                        header('location:./index.php?c=order&a=order');
                    }else{
                        header('location:./index.php?c=order&a=order');
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
       }

       //订单交易操作
       public function dodingdanguanli(){
        var_dump($_GET);
        $url = 'index.php?c=order&a=order';
        switch ($_GET['status']){
            case 0:
                header('location: '.$url);
                break;
            case 1:
                try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句 根据订单id查询订单状态
                    $sql = "UPDATE  orders SET status= 2 WHERE id='{$_GET['id']}'";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                header('location: '.$url);
                break;
            case 2:
                try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句 根据订单id查询订单状态
                    $sql = "UPDATE  orders SET status= 3  WHERE id='{$_GET['id']}'";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                header('location: '.$url);
                break;
            case 3:
                try {
                    //连接数据库
                    $dsn = 'mysql:host=localhost;dbname=myshop;charset=utf8';
                    // 得到PDO对象
                    $pdo = new PDO($dsn,'root');
                    // 设置错误
                    $pdo->setAttribute(3,1);
                    //准备sql语句 根据订单id查询订单状态
                    $sql = "UPDATE  orders SET status= 4 WHERE id='{$_GET['id']}'";
                    //发送sql语句
                    $stmt = $pdo->prepare($sql);
                    // 执行sql语句
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                header('location: '.$url);
                break;
            case 4:
                header('location: '.$url);
                break;
        }
       }

    }  