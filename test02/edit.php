<?php
    $id = $_GET["id"];
    if ($id == null){
        header("Location: index.php");
        exit;
    }
    // echo $msg;
    $servername = "localhost";
    $username = "root";
    $password = "root1234";
    $dbname = "bbs";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // 使用SELECT指令找出要編輯的對象
    $sql = "SELECT * FROM comment WHERE id='$id' LIMIT 1";
    // 以下執行SQL查詢命令，並把結果傳回給$result
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { // 檢查紀錄的數量，看是否有資料

        $row = $result->fetch_assoc(); // 從資料庫中取出一筆紀錄
        $id = $row["id"]; // 取得id欄位，放到$id中
        $msg = $row['msg'];// 取出msg欄位，放到$msg中
        // 以下建立一個用來編輯內容的表單，按下「修改」之後會前往update.php
        echo "<h3>你要修改的內容</h3>";
        echo "<form action='update.php' method='POST'>";
        echo "<input type='hidden' value='$id' name='id'>";
        echo "<input type='text' name='editMsg' value='$msg' size=30><br><br>";
        echo "<input type='submit' value='修改'>";
        echo "</form>";
        echo "<br> <a href='index.php'>不修改了啦，回去看嘴砲</a>";

    } else {
        echo "找不到你要編輯的訊息<br>";
        echo "<a href='index.php'>回上一頁</a>";
    }

    $conn->close();
    // header("Location: index.php");
?>