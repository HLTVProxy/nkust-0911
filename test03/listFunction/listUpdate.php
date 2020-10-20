<?php
    // 取得播放清單的id
    $id = $_POST["id"];
    // 取得修改後的播放清單名稱
    $editName = $_POST["editName"];
    if ($id == null){
        header("Location: index.php");
        exit;
    }
    // 讀取資料庫
    require "D:/AppServ/www/mysite/nkust-0903/includes/config.php";
    // 更新傳送過來id裡的播放清單名稱
    $sql = "UPDATE playlist SET name='$editName' WHERE id='$id' LIMIT 1";
    // 以下執行SQL查詢命令
    $result = $conn->query($sql);
    $conn->close();
    // 跳回去要記得用../
    header("Location: ../index.php");
?>