<?php
    // 登出用
    session_start();
    session_unset();
    header("Location: index.php");
    exit;
?>