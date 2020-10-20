<?php
    require "D:/AppServ/www/mysite/nkust-0903/includes/utils.php";
    session_start();
    $userType = $_SESSION['userType'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的播放清單(最終版)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- 排版 -->
    <style>
        #pTable{
            margin-left: 1%;
            text-align: center;
            background-color: #e6eeff;
            width: 50%;
        }
        th {
            border: 1px solid gray;
        }
        td{
            background-color: #99bbff;
        }
        body{
            background-color: #ffe6e6;
        }
        label, h3, a{
            margin: 1%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <h3>我的播放清單</h3>
    <?php include "../includes/menu.php"?>
    <hr>
    <?php
        require "../includes/config.php";
        // 以下建立SQL查詢命令
        $sql = "SELECT * FROM playlist ORDER BY id DESC";
        // 以下執行SQL查詢命令
        $result = $conn->query($sql);
        // 以下建立一個輸入密碼的表單
        // 使用者按下「登入」後，會前往chkpass.php檢查密碼
        
        // 檢查是否為登入狀態
        if($userType == null){
            echo "<form method='POST' action='chkpass.php'>";
            echo "<h4>登入後才能進行編輯喔</h4>";
            echo "管理員密碼：<input type='password' name='password' placeholder='密碼：1234'>";
            echo " <input type='submit' value='登入' class='btn btn-primary'>";
        }else{
            echo "<h3>今晚，你想看點什麼?</h3>
            <form method='POST' action='listFunction/listAdd.php'>
            <label>要新增的播放清單名稱：</label>
            <input type='text' name='listName'>
            <input type='submit' value='新增' class='btn btn-primary'>
            </form>
            <a href='logout.php' class='btn btn-danger'>登出</a><br><br>
            <hr>";
        };

        if ($result->num_rows > 0) { // 檢查紀錄的數量，看是否有資料
        // output data of each row
        echo "";
        // 生成播放清單出來
        echo "<table id='pTable'>
            <tr>
            <th>播放清單</th>";
        if ($userType !=null){
            echo "<th colspan='2'>清單管理</th>
            </tr>";
        }else echo "</tr>";
            
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $name = $row["name"];
            // 顯示資料庫有的播放清單
            echo "
                <tr>
                <td><a href='video.php?pid=$id&name=$name'>" .
                $row["name"] . "</a>(" . get_Vnumbers($id) . "支影片)
                </td>";
            // 判斷是否有登入，有登入才能做編輯和刪除
            if ($userType != null){
                echo "
                <td><a href='listFunction/listEdit.php?id=$id' class='btn btn-success'>編輯</a>
                </td>
                <td><a href='listFunction/listDelete.php?id=$id' class='btn btn-danger'>刪除</a>
                </td>
                </tr>";
            }else echo "</tr>";
            
        }
        echo "<table>";
        } else {
        echo "0 results";
        }
    ?>
    
    <hr>
    <?php
        getCounter("test03");
        $conn->close();
    ?>
    <hr>
    <?php include "../includes/footer.php"?>
</body>
</html>
