<?php
    session_start();
    $userType = $_SESSION['userType'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        #msgTable{
            text-align: center;
            background-color: #e6eeff;
            width: 500px;
        }
        th {
            border: 1px solid gray;
        }
        td{
            background-color: #99bbff;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <img src="../img/banner.jpg" alt="Banner"/>
    <hr>
    <?php include "../includes/menu.php"?>
    <hr>
    <?php
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
        // 以下建立SQL查詢命令
        $sql = "SELECT * FROM comment ORDER BY id DESC";
        // 以下執行SQL查詢命令
        $result = $conn->query($sql);
        // 以下建立一個輸入密碼的表單
        // 使用者按下「登入」後，會前往chkpass.php檢查密碼
        
        // 檢查是否為登入狀態
        if($userType == null){
            echo "<form method='POST' action='chkpass.php'>";
            echo "<h4>登入後才能來嘴砲</h4>";
            echo "張貼密碼：<input type='password' name='password'>";
            echo " <input type='submit' value='登入' class='btn btn-primary'>";
        }else{
            echo "<h3>今晚，你想嘴砲什麼?</h3>
            <a href='logout.php' class='btn btn-danger'>登出</a><br><br>";
            echo "<form action='post.php' method='POST'>
            <input type=text name=content placeholder='打入你想嘴的話'></input>
            <input type='submit' value='張貼' class='btn btn-primary'>
            </form><hr>";
        };

        if ($result->num_rows > 0) { // 檢查紀錄的數量，看是否有資料
        // output data of each row
        echo "";
        // 生成訊息出來
        echo "<table id='msgTable'>
            <tr>
            <th>訊息</th>
            <th>發布時間</th>";
        if ($userType !=null){
            echo "<th colspan='2'>貼文管理</th>
            </tr>";
        }else echo "</tr>";
            
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            echo "
                <tr>
                <td>$row[msg]</td>
                <td>$row[post_date]</td>
                ";
            if ($userType != null){
                echo "
                <td><a href='edit.php?id=$id' class='btn btn-success'>編輯</a>
                </td>
                <td><a href='delete.php?id=$id' class='btn btn-danger'>刪除</a>
                </td>
                </tr>";
            }else echo "</tr>";
            
   
        }
        echo "<table>";
        } else {
        echo "0 results";
        }
        $conn->close();
    ?>
    
    <hr>
    <?php include "../includes/footer.php"?>
</body>
</html>
