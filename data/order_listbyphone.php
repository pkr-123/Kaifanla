<?php
/*
根据客户电话号码获取所下过的订单；
*/
 header('Content-Type:application/json');
 $output=[];
 @$tel=$_REQUEST['phone'];//客户端提交的电话号码
 if(empty($tel)){
     echo "[]";
     return;//若未提供关键字查询 侧退出页面
 }
// var_dump($tel);
 $conn=mysqli_connect('127.0.0.1','root','','kaifanla');
 $sql='SET NAMES utf8';
 mysqli_query($conn,$sql);
 $sql="SELECT o.oid,o.order_time,o.user_name,d.img_sm FROM kf_order o,kf_dish d WHERE o.did=d.did and o.phone='$tel'";
 $result=mysqli_query($conn,$sql);
 while(($row=mysqli_fetch_assoc($result))!==NULL){
    $output[]=$row;
 }
// var_dump($output);
 echo json_encode($output)
?>