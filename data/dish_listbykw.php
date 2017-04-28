<?php
/*
更具客户端提交的查询关键字，返回菜名或者原料中包含指定关键字的菜品；
*/
 header('Content-Type:application/json');
 $output=[];

 @$kw=$_REQUEST['kw'];
 if(empty($kw)){
    echo "[]";
    return;//若未提供关键字查询 侧退出页面
 }
// var_dump($kw);
 //访问数据库
 $conn=mysqli_connect('127.0.0.1','root','','kaifanla');
 $sql='SET NAMES utf8';
 mysqli_query($conn,$sql);
 $sql="SELECT did,name,price,img_sm,material FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%'";
 $result=mysqli_query($conn,$sql);
 while(($row=mysqli_fetch_assoc($result))!==NULL){
    $output[]=$row;
 }
// var_dump($output);
 echo json_encode($output)
?>

