<?php
/*
由order.html调用
根据客户端订单信息 向订单表中插入一条记录 获得数据库返回的订单编号；
*/
 header('Content-Type:application/json');
 $output=[];
 @$user_name=$_REQUEST['username'];
 @$sex=$_REQUEST['sex'];
 @$phone=$_REQUEST['phone'];
 @$addr=$_REQUEST['addr'];
 @$did=$_REQUEST['did'];
 @$order_time=time()*1000;//php中的time（）函数返回当前系统的时间
 if(empty($user_name)||empty($sex)||empty($addr)||empty($did)){
     echo "[]";
     return;//若未提供关键字查询 侧退出页面
 }
// var_dump($tel);
 $conn=mysqli_connect('127.0.0.1','root','','kaifanla');
 $sql='SET NAMES utf8';
 mysqli_query($conn,$sql);
 $sql="INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$addr','$did')";
 $result=mysqli_query($conn,$sql);
// var_dump($result);
 $arr=[];
 if($result){
    $arr['mes']='succ';
    $arr['did']=mysqli_insert_id($conn);//获取最近执行的一条INERT语句生成的自增主键
 }else{
    $arr['mes']='err';
    $arr['reason']="SQL语句执行失败：$sql";

 }
 $output[]=$arr;
// var_dump($output);
 echo json_encode($output);
?>