<?php
    class IndexController{
        public function index(){
            // session_start();
            if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
                // echo '<script>alert("登录成功")</script>';
                include './View/index.html';
            }else{
                header('location:./index.php?c=user&a=login');
            }
        }
        
    }