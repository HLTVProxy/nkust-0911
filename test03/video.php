<?php
    $pid = $_GET["pid"];
    $v = $_GET["v"];
    $name = $_GET["name"];
    session_start();
    $userType = $_SESSION['userType'];
    // if ($userType == null){
    //     header("Location: index.php");
    //     exit;
    // }

    // Autoplay用法：vid?autoplay=1&mute=0
    $tags = "<iframe src='https://www.youtube.com/embed/^^^^?autoplay=1&mute=0' width='560' height='360' frameborder='0' allowfullscreen='allowfullscreen' allow='autoplay'></iframe>";
    $imgTag = "https://i.ytimg.com/vi/^^^^/hqdefault.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php echo "<title>$name</title>"?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        #vTable{
            margin: 1%;
            text-align: center;
            background-color: #e6eeff;
            width: 60%;
            float: left;
        }
        iframe{
            float: right;
        }
        th {
            border: 1px solid gray;
        }
        td{
            background-color: #f2f2f2;
        }
        body{
            background-color: #e0e0eb;
        }
        iframe, label, h3, a{
            margin-left: 1%;
        }
        .clearfix{
            clear: both;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <?php echo "<h3>$name</h3>"?>
    <?php include "../includes/menu.php"?>
    <hr>
    <?php
        require "../includes/config.php";
        // 以下建立SQL查詢命令
        $sql = "SELECT * FROM video WHERE pid='$pid'";
        // 以下執行SQL查詢命令
        $result = $conn->query($sql);
        // 以下建立一個輸入密碼的表單
        // 使用者按下「登入」後，會前往chkpass.php檢查密碼
        
        // 檢查是否為登入狀態
        if($userType == null){
            // redir用來做登入導原元網頁
            echo "<form method='POST' action='chkpass.php?redir=video.php?pid=$pid'>";
            echo "<h3>登入後才能編輯影片內容喔</h3>";
            // echo "<label>管理員密碼：</label>";
            // echo "<input type='password' name='password' placeholder='輸入你的密碼'>";
            // echo "<input type='submit' value='登入' class='btn btn-primary'><br>";
            echo "<a href='index.php'>回到上一頁</a>";
            echo "<div></div>";
        }else{
            // 登入後能新增影片
            echo "<a href='index.php' class='breadcrumb-item'>回到上一頁</a><br>";
            echo "<a href='logout.php' class='btn btn-danger'>登出</a><br><br>";
            echo "<form action='videoFunction/vAdd.php' method='POST'>
            <label>要新增的影片名稱：</label>
            <input type='text' name='vName'>
            <label>要新增的Yotube影片ID：</label>
            <input type='text' name='vId'>
            <input type='submit' value='新增' class='btn btn-primary'>
            <input type='hidden' name='pid' value='$pid'>
            </form><br>
            <hr>";
            
        };
        if ($result->num_rows > 0) { // 檢查紀錄的數量，看是否有資料
        // output data of each row
        echo "";
        // 生成影片清單出來
        // <th>影片標題</th>
        echo "<table id='vTable' width:100%>
            <tr>
            
            <th>影片縮圖</th>";
            // <th>影片ID</th>";
        if ($userType !=null){
            echo "<th colspan='2'>影片管理</th>
            </tr>";
        }else echo "</tr>";
        
        // 抓第一筆影片當作預設值
        $vc = 0;
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>     
                <td>$row[title]<br>
                <a href=video.php?pid=$pid&v=$row[vid]&name=$name><img src='" . str_replace("^^^^",$row["vid"],$imgTag) . "' width = 200></a>
                </img>
                </td>";
                
                // <td>$row[vid]</td>";
            // 登入後能做影片管理，編輯和刪除用GET方式傳送處理
            if ($userType != null){
                echo "
                <td><a href='videoFunction/vEdit.php?id=$row[id]&pid=$pid' class='btn btn-success'>編輯</a>
                </td>
                <td><a href='videoFunction/vDelete.php?id=$row[id]&pid=$pid' class='btn btn-danger'>刪除</a>
                </td>
                </tr>";
            }else echo "</tr>";
            
        }
        echo "<table>";
        } else {
        echo "<h3>請新增影片才能觀看喔!</h3>";
        }

        // 設定預設影片
        $sql = "SELECT * FROM video where pid = $pid ORDER BY id ASC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
        }else{
            $df = "1BBw4oyOMG0";
        }

        // 放置影片
        if($v == null){
            // 設定預設影片，若無資料庫沒東西的話則會顯示要新增影片才能觀看
            if($row["vid"] != null){
                echo "<h3>點擊左方影片縮圖切換影片</h3>";
                echo str_replace("^^^^", $row["vid"], $tags);
            }else{
                echo str_replace("^^^^", $df, $tags);
            }
           
        }else{
            echo str_replace("^^^^", trim($v), $tags);
            echo "<div></div>";
        }
        $conn->close();
    ?>
    </div>
    <div class='clearfix'> 
    </div>
    <hr>
    <?php include "../includes/footer.php"?>
</body>
</html>
