<?php
 if (!isset($_SESSION['home'])) {
                header('location:./index.php?c=index&a=login');
            }


   //  class A{
   
   // //调用一个不存在的方法的时候自动调用
   // public function __call($a,$b){
   // echo 'yyyyyyyyyyy';

   //  }