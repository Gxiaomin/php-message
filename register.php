<?php
    session_start();

    include ("input.php");
    include ("db.php");

    $input = new Input();
    $act = $input->get('act');

    
    if($act !== false) {
        $admin = $input->post('admin');
        $pwd = $input->post('password');
        //必填校验
        if($admin === '' || $pwd === '') {
            echo "用户名或密码为空！";
            exit;
        }

        $time = time();
        
        $select = "select * from token where user='$admin'";
        $mysqli_result = $mysqli->query($select);
        // 返回结果集中行的数目
        $num = mysqli_num_rows($mysqli_result);
        if($num) {
            echo "<script>alert('用户已存在！'); history.go(-1);</script>";
        }else {
            $sql = "INSERT INTO token (user,pwd,create_time) VALUES ('$admin','$pwd','$time')";
            $result = $mysqli->query($sql);
            if($result) {
                //跳转
                header("location:login.php");
            }else {
                echo "注册失败，请重试！";
            }
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
        <form class="login-form" action="register.php?act=ack" method="post">
            <input type="text" name="admin" placeholder="请输入用户名">
            <input type="password" name="password" placeholder="请输入密码">
            <div class="form-footer">
                <button class="register btn" type="submit">注册</button>
            </div>
        </form>
    </div>
</body>
</html>