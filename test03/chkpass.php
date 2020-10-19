<?php
    session_start();
    $password = $_POST["password"];
    $redir = $_GET["redir"];
    echo $pid;
    // echo $password;
    if ($password == '1234'){
        $_SESSION['userType'] = 1;
        // rediret to test.php
        if ($redir != null){
            // 表示有指定要前往的網頁，所以就要把Location後面加上指定的目標網頁
            header("Location: $redir");
            
        }else{
            // 運用header()進行轉址
            header("Location: index.php");
            // 跟php說我要離開了
            exit;
        }
    }else{
        $_SESSION['userType'] = 0;
        echo "密碼輸入錯誤，請回到上一頁重新填寫<br>";
        echo "<a href='index.php'>回上一頁</a>";
    }
?>
