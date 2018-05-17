<?php 
    //面向过程化写法(不推荐这种写法)
    // $mysqli = mysqli_connect('127.0.0.1','root','000000','message'); 
    // var_dump($mysqli); 
    // if(!$mysqli) {
    //     echo "连接错误！";
    //     echo $mysqli_connect_errno();
    //     exit;
    // }

    //面向对象
    $mysqli = new mysqli('127.0.0.1','root','000000','message');
    // var_dump($mysqli->connect_errno); //int (0)
    if($mysqli->connect_errno > 0) {
        echo "连接错误：".$mysqli->connect_errno;
        exit;
    }
    // echo "连接成功";
    $mysqli->query("SET NAMES UTF8");
?>