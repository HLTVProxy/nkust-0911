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
    // 使用Delete From指令
    $sql = "DELETE FROM comment WHERE id='$id' LIMIT 1";
    // 以下執行SQL查詢命令
    $result = $conn->query($sql);
    $conn->close();
    header("Location: index.php");
?>