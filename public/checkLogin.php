<?php
 if (!isset($_SESSION['admin'])) {
                header('location:./index.php?c=user&a=login');
            }


   //  class A{
   
   // //调用一个不存在的方法的时候自动调用
   // public function __call($a,$b){
   // echo 'yyyyyyyyyyy';

   //  }