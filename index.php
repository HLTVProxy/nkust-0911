<?php
    require "includes/config.php";
    require "includes/utils.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>何榮廷0911最終版</title>
    <style>
        body {
            font-family: 微軟正黑體 ;
        }
    </style>
</head>
<body>
    <h1>何榮廷0903 PHP練習紀錄</h1>
    <hr>
    <?php include("includes/menu.php");?>
    <hr>
    <?php
        getCounter("homepage");
    ?>
    <hr>
    <?php include("includes/footer.php");?>
</body>
</html>