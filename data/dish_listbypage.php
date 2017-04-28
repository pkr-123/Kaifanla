<?php
/*
更具客户端提交的菜品序号，泛会所对应的菜品最多五条记录；
*/
 header('Content-Type:application/json');
 $output=[];
 $count=5;//一次对多返回五条记录
 @$start=$_REQUEST['start'];//客户端提交的起始记录 @$start = $_REQUEST['start'];
 if(empty($start)){
    $start=0;
 }
 $conn=mysqli_connect('127.0.0.1','root','','Kaifanla','3306');
 $sql='SET NAMES utf8';
 mysqli_query($conn,$sql);
 $sql="SELECT did,name,price,img_sm,material FROM kf_dish LIMIT $start,$count";
 $result=mysqli_query($conn,$sql);
 while(($row=mysqli_fetch_assoc($result))!==NULL){
    $output[]=$row;
 }
 echo json_encode($output);
?>