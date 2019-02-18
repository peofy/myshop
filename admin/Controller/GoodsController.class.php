<?php
    //商品管理模块
    class GoodsController{
        //商品列表方法
        public function index(){
            include '../public/checkLogin.php';
            // echo '商品列表';
            // 接收搜索条件
           // var_dump($_GET);
            if(empty($_GET['name'])){
                $data = array();
            }else{
                $data['name'] = array('like',$_GET['name']);
            }
            // 得到商品对象
            //将数据遍历到表格中
            $goods = new Model('goods');
            $total = $goods->where($data)->count();
            //得到分页类
            $page = new Page($total,3);
            //商品类别数组
            $goodslist = $goods->where($data)->limit($page->limit)->select();
            // var_dump($goodslist);
            $i = 1;
            include './View/goods/index.html';
        }
        //添加商品方法
        public function add(){
            include '../public/checkLogin.php';
            // echo '添加商品';
            // 查询所有分类信息
            $type = new Model('type');
            $typelist = $type->order('concat(path,id,",") ASC')->select();
            include './View/goods/add.html';
        }
        //处理商品添加方法
        public function doadd(){
            include '../public/checkLogin.php';
            // var_dump($_POST);
            // var_dump($_FILES);
            //排除没有填写内容
            foreach($_POST as $value){
                if ($value == ''){
                    echo '请填写内容';exit;
                }
            }
            //文件上传
            //得到文件上传对象
            $upload = new Uploads('pic');
            $upload->typelist = array('image/jpeg','image/jpg','image/gif','image/png');
            //初始化保存路径
            $upload->path='../public/goods/';
            //执行文件上传
            $bool = $upload->upload();
            if(!$bool){
                echo '文件上传失败';exit;
            }
            // var_dump($upload);
            //获取文件上传成功的名字
            $_POST['pic'] = $upload->savename;
            // var_dump($_POST);
            // 进行数据添加
            $goods = new Model('goods');
            $bool = $goods->add($_POST);
            // var_dump($bool);
            if($bool){
                echo '<script>alert("添加成功");location="./index.php?c=goods&a=index";</script>';
            }else{
                //如果添加失败考虑是否是文件上传输出问题，如果不是要删除文件
                unlink('../public/goods/'.$_POST['pic']);
                echo '<script>alert("添加失败");location="./index.php?c=goods&a=index";</script>';
            }
        }
        //上下架方法
        public function status(){
            include '../public/checkLogin.php';
            var_dump($_GET);
            $data = array();
            $data['id'] = $_GET['id'];
            $data['status'] = $_GET['status'];

            //链接数据库
            $goods = new Model('goods');
            //修改数据
            if($goods->update($data)){
                header('location:./index.php?c=goods&a=index');
            }else{
                header('location:./index.php?c=goods&a=index');
            }
        }

        //删除方法
        public function del(){
            include '../public/checkLogin.php';
            // var_dump($_GET);
            // 获取商品id
            $goodsid = $_GET['id'];
            //取出图片名
            $goods = new Model('goods');
            // 通过商品id找到商品图片所在的位置
            $goodslist = $goods->find($goodsid);
            // var_dump($goodslist);
            // 取出商品图片名称
            $oldimagename = $goodslist['pic'];
            // echo $oldimage;
            // 删除数据库内容
            $result = $goods->del($goodsid);
            // var_dump($result);
            //判断是否删除成功
            if($result){
                //删除商品图片
                unlink('../public/goods/'.$oldimagename);
                header('location:./index.php?c=goods&a=index');
            }else{
                header('location:./index.php?c=goods&a=index');
            }
        }
        //编辑方法
        public function edit(){
            include '../public/checkLogin.php';
            // var_dump($_GET);
            $type = new Model('type');
            $typelist = $type->order('concat(path,id,",") ASC')->select();
            // 获取商品id
            $goodsid = $_GET['id'];
            //通过商品id找到商品信息
            $goods = new Model('goods');
            $goodslist = $goods->find($goodsid);
            // var_dump($goodslist);
            include './View/goods/edit.html';

        }

        // 处理编辑方法
        public function doedit(){
            include '../public/checkLogin.php';
            $goodsid = $_POST['id'];
            //通过商品id找到商品信息
            $goods = new Model('goods');
            $goodslist = $goods->find($goodsid);
            // var_dump($goodslist);
            // 将图片名添加到$_POST数组里
            $_POST['pic'] = $goodslist['pic'];

            // var_dump($_POST);
            // var_dump($_FILES);
            //遍历$_FILES得到得到图片数组
            foreach($_FILES as $value){
            // 判断图片名字是否为空，如果为空证明图片没有被修改可以直接修改数据
                if(empty($value['name'])){
                    $bool = $goods->update($_POST);
                    if($bool){
                        echo '<script>alert("修改成功");location="./index.php?c=goods&a=index";</script>';
                    }else{
                        echo '<script>alert("未修改任何数据");location="./index.php?c=goods&a=index";</script>';
                    }
                }else{
                    unlink('../public/goods/'.$_POST['pic']);
                    //程序走到这里证明图片名字不为空，图片被修改
                    //得到文件上传对象 
                    // var_dump($_POST);
                    $upload = new Uploads('pic');
                    $upload->typelist = array('image/jpeg','image/jpg','image/gif','image/png');
                    //初始化保存路径
                    $upload->path='../public/goods/';
                    //执行文件上传
                    $bool = $upload->upload();
                    if(!$bool){
                        echo '文件上传失败';exit;
                    }
                    // var_dump($upload);
                    //获取文件上传成功的名字
                    $_POST['pic'] = $upload->savename;
                    //修改数据
                    $bool = $goods->update($_POST);
                    if($bool){
                        echo '<script>alert("修改成功");location="./index.php?c=goods&a=index";</script>';
                    }else{
                        echo '<script>alert("修改失败");location="./index.php?c=goods&a=index";</script>';
                    }
                }

            }

        }
    }