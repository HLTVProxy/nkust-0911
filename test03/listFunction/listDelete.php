<?php
    // 取得播放清單的id
    $id = $_GET["id"];
    if ($id == null){
        header("Location: index.php");
        exit;
    }
    // 讀取資料庫
    require "D:/AppServ/www/mysite/nkust-0903/includes/config.php";
    // 用id來刪除播放清單
    $sql = "DELETE FROM playlist WHERE id='$id' LIMIT 1";
    // 以下執行SQL查詢命令
    $conn->query($sql);
    // 刪除影片清單的影片
    $sql = "DELETE FROM video WHERE pid='$id'";
    $conn->query($sql);

    $conn->close();
    // 跳回去要記得用../
    header("Location: ../index.php");
?>