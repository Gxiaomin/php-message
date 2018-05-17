<?php
    session_start();

    include ("input.php");
    include ("db.php");

    $input = new Input();
    $act = $input->get('ack');

    if($act !== false) {
        $admin = $input->post('admin');
        $pwd = $input->post('password');
        $sql = "select * from login where admin='$admin' and pwd='$pwd'";
        $mysqli_result = $mysqli->query($sql);
        if($row = $mysqli_result->fecth_array()) {
            $_SESSION['admin'] = $row['admin'];
            header("location:message.php");
        }else {
            echo "用户名或密码错误！";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>留言板</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/reset.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./css/index.css" />
</head>
<body>
    <div class="wrapper">
        <form class="login-form" action="login.php?act=chk" method="post">
            <input type="text" name="admin" placeholder="请输入用户名">
            <input type="password" name="password" placeholder="请输入密码">
            <div class="form-footer">
                <button class="login btn" type="submit">登录</button>
                <button class="register btn" type="submit">注册</button>
            </div>
        </form>
    </div>
</body>
</html>