<?php
    session_start();

    include ("input.php");
    include ("db.php");

    $input = new Input();
    $act = $input->get('act');

    if($act !== false) {
        $admin = $input->post('admin');
        $pwd = $input->post('password');

        $sql = "select * from token where user='$admin'";
        $mysqli_result = $mysqli->query($sql);
        $num = mysqli_num_rows($mysqli_result);

        if($num) {
            $select = "select * from token where user='$admin'and pwd='$pwd'";
            $result = $mysqli->query($select);

            if($row = $result->fetch_array()) {
                $_SESSION['user'] = $row['user'];
                header("location:message.php");
            }else {
                echo "<script>alert('用户名或密码错误！'); history.go(-1);</script>";
            }
        }else {
            echo "<script>alert('用户名不存在，请先前往注册！'); history.go(-1);</script>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>留言板</title>
    <link rel="stylesheet" type="text/css" media="screen" href="./css/reset.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./css/login.css" />
</head>
<body>
    <div class="wrapper">
        <form class="login-form" action="login.php?act=chk" method="post">
            <input type="text" name="admin" placeholder="请输入用户名">
            <input type="text" onfocus="this.type='password'" name="password" placeholder="请输入密码">
            <div class="form-footer">
                <button class="login btn" type="submit">登录</button>
                <a class="go-register-btn" href="register.php">立即注册</a>
            </div>
        </form>
    </div>
</body>
</html>