<?php
    // 取得影片的id
    $id = $_POST["id"];
    // 取得修改後的標題、Youtube影片id和要回到的播放清單pid
    $pid = $_POST["pid"];
    $editTitle = $_POST["editTitle"];
    $editVid = $_POST["editVid"];
    if ($editTitle == null || $editVid == null){
        header("Location: ../video.php?pid=$pid");
        exit;
    }
    // 讀取資料庫
    require "D:/AppServ/www/mysite/nkust-0903/includes/config.php";
    // 更新傳送過來id裡的影片標題及ID
    $sql = "UPDATE video SET title='$editTitle',vid='$editVid' WHERE id='$id' LIMIT 1";
    // 以下執行SQL查詢命令
    $result = $conn->query($sql);
    $conn->close();
    // 跳回去要記得用../，而且要使用?$pid=$pid才能跳回原本在的播放清單
    header("Location: ../video.php?pid=$pid");
?>