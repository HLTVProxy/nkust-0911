<?php
    // 取得播放清單的id
    $id = $_GET["id"];
    if ($id == null){
        header("Location: index.php");
        exit;
    }
    // 讀取資料庫
    require "D:/AppServ/www/mysite/nkust-0903/includes/config.php";
    // 編輯傳送過來id裡的內容
    $sql = "SELECT * FROM playlist WHERE id='$id' LIMIT 1";
    // 以下執行SQL查詢命令，並把結果傳回給$result
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { // 檢查紀錄的數量，看是否有資料

        $row = $result->fetch_assoc(); // 從資料庫中取出一筆紀錄
        $id = $row["id"]; // 取得id欄位，放到$id中
        $name = $row["name"];// 取出name欄位，放到$name中
        // 以下建立一個用來編輯內容的表單，按下「修改」之後會前往update.php
        echo "<h3>你要修改的播放清單內容</h3>";
        echo "<form action='listUpdate.php' method='POST'>";
        // id用來指定要更新的播放清單
        echo "<input type='hidden' value='$id' name='id'>";
        // 要修改的播放清單名稱
        echo "<input type='text' name='editName' value='$name' size=30><br><br>";
        echo "<input type='submit' value='修改'>";
        echo "</form>";
        echo "<br> <a href='/mysite/nkust-0903/test03'>回上一頁</a>";

    } else {
        echo "找不到你要編輯的訊息<br>";
        echo "<a href='/mysite/nkust-0903/test03'>回上一頁</a>";
    }

    $conn->close();
    // header("Location: index.php");
?>