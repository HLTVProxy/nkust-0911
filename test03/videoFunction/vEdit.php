<?php
    // 取得影片的id
    $id = $_GET["id"];
    $pid = $_GET["pid"];
    if ($id == null){
        header("Location: ../video.php");
        exit;
    }
    // 讀取資料庫
    require "D:/AppServ/www/mysite/nkust-0903/includes/config.php";
    
    $sql = "SELECT * FROM video WHERE id='$id' LIMIT 1";
    // 以下執行SQL查詢命令，並把結果傳回給$result
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { // 檢查紀錄的數量，看是否有資料

        $row = $result->fetch_assoc(); // 從資料庫中取出一筆紀錄
        $id = $row["id"]; // 取得id欄位，放到$id中
        $title = $row["title"];// 取出title欄位，放到$title中
        $vid = $row["vid"];// 取出vid欄位，放到$vid中
        // 以下建立一個用來編輯內容的表單，按下「修改」之後會前往vUpdate.php
        echo "<h3>你要修改的播放清單內容</h3>";
        echo "<form action='vUpdate.php' method='POST'>";
        // id和pid是分別要給vUpdate進行指定及導回原本的播放清單
        echo "<input type='hidden' value='$id' name='id'>";
        echo "<input type='hidden' value='$pid' name='pid'>";
        echo "<label>影片標題：</label>";
        // 要修改的標題
        echo "<input type='text' name='editTitle' value='$title' size=30><br><br>";
        echo "<label>影片ID：</label>";
        // 要修改的影片ID
        echo "<input type='text' name='editVid' value='$vid' size=30><br><br>";
        echo "<input type='submit' value='修改'>";
        echo "</form>";
        echo "<br> <a href='/mysite/nkust-0903/test03'>回上一頁</a>";

    } else {
        echo "找不到你要編輯的訊息<br>";
        echo "<a href='/mysite/nkust-0903/test03'>回上一頁</a>";
    }

    $conn->close();
?>