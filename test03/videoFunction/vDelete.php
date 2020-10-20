<?php
    // 取得影片的id及播放清單的pid
    $id = $_GET["id"];
    $pid = $_GET["pid"];
    if ($id == null){
        header("Location: ../video.php?pid=$pid");
        exit;
    }
    // 讀取資料庫
    require "D:/AppServ/www/mysite/nkust-0903/includes/config.php";
    // 用id來刪除影片
    $sql = "DELETE FROM video WHERE id='$id' LIMIT 1";
    // 以下執行SQL查詢命令
    $result = $conn->query($sql);
    $conn->close();
    // 跳回去要記得用../，而且要使用?$pid=$pid才能跳回原本在的播放清單
    header("Location: ../video.php?pid=$pid");
?>