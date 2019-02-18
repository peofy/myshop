<?php

//会员模块
	class UserController{
        //显示个人中心
         public function personal(){
            include '../public/icheckLogin.php';
            
            include './Include/head.html';
            include './View/personal.html';
            include './Include/foot.html';
        }
         
        
        
        public function information(){

            include '../public/icheckLogin.php';
            //通过用户id查找user_info是否有数据
            $info = new Model('user_info');
            $data['uid'] = $_SESSION['home']['id'];
            echo '<input type="hidden">';
            $result = $info->where($data)->find();
            // var_dump($result);
            // //加载详情页面显示
            include './Include/head.html';
            include './View/information.html';
            include './Include/foot.html';
        }



         public function douserinfo(){
            // include '../public/icheckLogin.php';          
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
                    echo '<script>alert("上传失败");location="./index.php?c=user&a=information";</script>';
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
                    echo '<script>alert("添加成功");location="./index.php?c=user&a=information";</script>';
                

                 }else{
                    echo '<script>alert("添加失败");location="./index.php?c=user&a=information";</script>';
                    
            
                    
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
                    if($bool){
                        echo '<script>alert("修改成功");location="./index.php?c=user&a=information";</script>';
                    }else{
                        echo '<script>alert("未修改任何数据");location="./index.php?c=user&a=information";</script>';
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
                     if($result){
                        //删除旧图片
                        @unlink('../public/uploads/'.$oldimgname);
                        echo '<script>alert("修改成功");location="./index.php?c=user&a=information";</script>';
                     }else{
                        echo '<script>alert("未修改任何数据");location="./index.php?c=user&a=information";</script>';
                     }
            }
        }
    }
	}
