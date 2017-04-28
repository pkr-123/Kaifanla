<?php
/*
由detail.html调用
根据客户提交的菜品编号；
*/
 header('Content-Type:application/json');
 $output=[];
 @$did=$_REQUEST['did'];//客户端提交的菜品编号
 if(empty($did)){
     echo "[]";
     return;//若未提供关键字查询 侧退出页面
 }
 $conn=mysqli_connect('127.0.0.1','root','','kaifanla');
 $sql='SET NAMES utf8';
 mysqli_query($conn,$sql);
 $sql="SELECT did, name,img_lg,material,detail,price FROM kf_dish WHERE did=$did";
 $result=mysqli_query($conn,$sql);
 //根据编号查询 结果集最多只有 一个记录
 if(($row=mysqli_fetch_assoc($result))!==NULL){
    $output[]=$row;
 }
 echo json_encode($output);
?>