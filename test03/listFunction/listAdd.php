<?php
    // 取得播放清單的名稱
    $name = $_POST["listName"];
    // 讀取資料庫
    require "D:/AppServ/www/mysite/nkust-0903/includes/config.php";
    // 新建播放清單
    $sql = "INSERT INTO playlist(name)
    VALUE ('$name')";
    // 以下執行SQL查詢命令
    $result = $conn->query($sql);
    $conn->close();
    // 跳回去要記得用../
    header("Location: ../index.php");
?>