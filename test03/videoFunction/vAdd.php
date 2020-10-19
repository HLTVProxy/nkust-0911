<?php
    // 取得標題、Youtube影片id及播放清單的pid
    $vName = $_POST["vName"];
    $vid = $_POST["vId"];
    $pid = $_POST["pid"];
    if($vName == NULL || $vId == NULL){
        header("Location: ../video.php?pid=$pid");
        exit;
    }
    // 讀取資料庫
    require "D:/AppServ/www/mysite/nkust-0903/includes/config.php";
    // 新增資料之前，先檢查該筆vid有沒有在資料庫裡面
    $sql = "SELECT * FROM video WHERE vid = '$vid'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0){
        // 新建影片標題及vid
        $sql = "INSERT INTO video (title, vid, pid)
        VALUES ('$vName', '$vid','$pid')";
        // 以下執行SQL查詢命令
        $conn->query($sql);
    }
    $conn->close();
    // 跳回去要記得用../，而且要使用?$pid=$pid才能跳回原本在的播放清單
    header("Location: ../video.php?pid=$pid");
?>