<?php
    //订单管理模块
    class OrdersController{
         
        //订单列表
         public function index(){
            include '../public/checkLogin.php';
            if(empty($_GET['name'])){
                $data = array();
            }else{
                $data['name'] = array('like',$_GET['name']);
            }
            //将数据遍历到表格中
           $orders = new Model('orders');
           $total = $orders->where($data)->count();
           //得到分页类
           $page = new Page($total,5);
           $orderslist = $orders->where($data)->limit($page->limit)->select(); 
           
            
            include './View/orders/index.html';
        }
         //上下架方法
        public function status(){
            include '../public/checkLogin.php';
            $data = array();
            $data['id'] = $_GET['id'];
            $data['status'] = $_GET['status'];

            //链接数据库
            $orders = new Model('orders');
            //修改数据
            if($orders->update($data)){
                header('location:./index.php?c=orders&a=index');
            }else{
                header('location:./index.php?c=orders&a=index');
            }
        }
        // 订单详情
        public function order_info(){
            include '../public/checkLogin.php';
            $data['oid'] = $_GET['id'];
            //将数据遍历到表格中
           $orders = new Model('order_info');
           $total = $orders->where($data)->count();
           //得到分页类
           $page = new Page($total,5);
           $ordersinfo = $orders->where($data)->limit($page->limit)->select(); 
            include './View/orders/order_info.html';

        }

        //订单发货处理
        public function fahuo(){
            include '../public/checkLogin.php';
            $data['id'] = $_GET['id'];
            //将数据遍历到表格中
            $orders = new Model('orders');
            $total = $orders->where($data);
            //得到分页类
            $status['status'] = 1;
            var_dump($status);
            $page = new Page($total,5);
            $ordersinfo = $orders->where($data)->update($status);;
            if($ordersinfo){
                header('location:./index.php?c=orders&a=index');
            }else{
                header('location:./index.php?c=orders&a=index');
            }
        }

    }