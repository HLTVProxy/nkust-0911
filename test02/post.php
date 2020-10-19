<?php
    $msg = $_POST["content"];
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
    // 以下建立SQL查詢命令
    $sql = "INSERT INTO comment(msg)
    VALUE ('$msg')";
    // 以下執行SQL查詢命令
    $result = $conn->query($sql);
    $conn->close();
    header("Location: index.php");
?>