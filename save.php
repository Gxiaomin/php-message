<?php
    //引入相关文件
    include ("input.php");
    include ("db.php");

    $i = new Input();
    $msg = $i->post('msg');
    $user = $i->post('user');
    //必填校验
    if($msg === '' || $user === '') {
        echo "用户名或留言内容不能为空！";
        exit;
    }

    //获取当前时间
    $time = time();

    //sql语句
    $sql = "INSERT INTO msg (username,content,create_time) VALUES ('$user','$msg','$time')";
    //执行sql语句，插入数据库
    $isInsert = $mysqli->query($sql);
    if($isInsert) {
        //跳转
        header("location:message.php");
        // echo "留言成功！";
    }else {
        echo "留言失败，请刷新重试！";
    }
?>