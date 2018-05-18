<?php
    include ("input.php");
    include ("db.php");

    $input = new Input();
    $id = $input->get('id');
    $sql = "delete from msg where id='$id'";
    $result = $mysqli->query($sql);

    if($result) {
        header("location:message.php");
    }else {
        echo "<script type='text/javascript'>alert('删除失败，请刷新重试！'); history.go(-1);</script>";
    }
    
?>