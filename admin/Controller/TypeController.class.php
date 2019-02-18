<?php
    //分类模块
    class TypeController{
        public function index(){
            include '../public/checkLogin.php';
            //判断是否点击子分类
            if(empty($_GET[id])){
                //点击的是分类列表
                $data['pid']=0;
            }else{
                //点击查看子分类
                $data['pid'] = $_GET['id'];
            }
            $type = new Model('type');
            $typelist = $type->where($data)->select();
            $i = 1;
            include './View/type/index.html';
        }
        //添加页面
        public function add(){
            include '../public/checkLogin.php';
            if(empty($_GET['id'])){
                //要添加顶级分类
                $pid = 0;
                $path = '0,';
            }else{
                // 要添加子分类
                $pid = $_GET['id'];
                $type = new Model('type');
                $typeinfo = $type->find($pid);
                // var_dump($typelist);
                $path = $typeinfo['path'].$pid.',';
            }
            include './View/type/add.html';
        }

        public function doadd(){
            include '../public/checkLogin.php';
            $type = new Model('type');
            if($type->add($_POST)){
                echo '<script>alert("添加成功");location="./index.php?c=type&a=index";</script>';
            }else{
                echo '<script>alert("添加失败");location="./index.php?c=type&a=index";</script>';
            }
        }

        //删除方法
        public  function del(){
            include '../public/checkLogin.php';
            // var_dump($_GET['id']);
            // 通过id进行查询看他作为pid的时候是否有值，如果没有可以删除，如果有不可以删除
            $type = new Model('type');
            $data['pid'] = $_GET['id'];
            $result = $type->where($data)->select();
            // var_dump($result);
            if($result){
                echo '有子类，不可以删除';
            }else{
                //说明没有子类，可以删除
                if($type->del($_GET['id'])){
                    header('location:./index.php?c=type&index');
                }else{
                    header('location:./index.php?c=type&index');
                }
            }
        }
        //显示隐藏方法
        public function display(){
            include '../public/checkLogin.php';
            // var_dump($_GET);
            $data = array();
            $data['id'] = $_GET['id'];
            $data['display'] = $_GET['display'];

            //链接数据库
            $type = new Model('type');
            //修改数据
            if($type->update($data)){
                header('location:./index.php?c=type&a=index');
            }else{
                header('location:./index.php?c=type&a=index');
            }
        }
        //修改方法
        public function edit(){
            include '../public/checkLogin.php';
            // var_dump($_GET);
            //得到要修改的id
            $typeid = $_GET['id'];
            //根据id查到要修改的数据
            $type = new Model('type');
            $typelist = $type->find($typeid);
            // var_dump($typelist);
            include './View/type/edit.html';
        }
        // 处理修改方法
        public function doedit(){
            include '../public/checkLogin.php';
            // var_dump($_POST);
            //得到处理对象
            $type = new Model('type');
            //修改数据
            $bool = $type->update($_POST);
            if($bool){
                echo '<script>alert("修改成功");location="./index.php?c=type&a=index";</script>';
            }else{
                 echo '<script>alert("未修改任何数据");location="./index.php?c=type&a=index";</script>';
            }
        }
    }



       