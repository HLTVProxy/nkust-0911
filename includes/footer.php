<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body >
<center style="color: gray;">No Copyright lol 你載入這個頁面的時間是：
<?php
    $date = date("Y/m/d");
    // date_default_timezone_set("Asia/Taipei");
    $time = date("h:i:sa");
    echo $date . " " . $time;
?>
</center>
</body>
</html>

