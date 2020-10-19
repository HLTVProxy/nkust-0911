<?php
    session_start();
    $password = $_POST["password"];
    // echo $password;
    if ($password == '1234'){
        $_SESSION['userType'] = 1;
        // rediret to test.php
        header("Location: index.php");
        exit;
    }else{
        $_SESSION['userType'] = 0;
        echo "密碼輸入錯誤，請回到上一頁重新填寫<br>";
        echo "<a href='index.php'>回上一頁</a>";
    }
?>
