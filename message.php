<?php 
    session_start();

    //引入 连接数据库方法
    include ("db.php");

    //读取用户信息
    $user = $_SESSION['user'];
    $select = "select * from token where user='$user'";
    $result = $mysqli->query($select);
    $userInfo = $result->fetch_array();

    //查询sql
    $sql = "SELECT * FROM msg ORDER BY id DESC";
    //读取数据库message中留言列表
    $mysqli_result = $mysqli->query($sql);
    $rows = array();
    while($row = $mysqli_result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>留言板</title>
    <link rel="stylesheet" type="text/css" media="screen" href="./css/reset.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./css/message.css" />
</head>
<body>
    <header>
        <div class="user-wrapper">
            <?php
                echo $user."，你好！"
            ?>
            <a href="logout.php" class="logout">退出</a>
        </div>
        <p>欢迎来到小小留言板~~~~</p>
    </header>
    <section>
        <div class="message-panel">
            <div class="panel-title">留言列表</div>
            <ul class="message-list">
                <?php
                    foreach($rows as $row) {
                ?>
                    <li>
                        <div class="message">
                            <p class="message-user"><?php echo $row['username']."："?></p>
                            <div class="message-content"><?php echo $row['content']?></div>
                        </div>
                        <!-- 只有管理员有删除权限 -->
                        <?php
                            if($userInfo['role'] == 2) {
                        ?>
                            <div class="handle">
                                <span class="handle-delete">删除</span>
                            </div>
                        <?php
                            }
                        ?>
                    </li>
                <?php
                    }
                ?>
            </ul>
        </div>
        <div class="message-board">
            <form class="message-form" action="save.php" method="post">
                <div class="message-board-left">
                    <textarea name="msg" placeholder="请输入留言内容~~~~"></textarea>
                </div>
                <button type="submit">提交</button>
            </form>
        </div>
    </section>
    <footer>
        @初步尝试使用PHP写留言板功能~~~
    </footer>
</body>
</html>