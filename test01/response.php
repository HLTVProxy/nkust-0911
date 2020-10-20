<?php
    $year = $_POST["year"] + 1911;
    $month = $_POST["month"];
    $day = $_POST["day"];
    
    $birthDay = "你的生日$year-$month-$day";
    echo "<script>alert('$birthDay');</script>";
?>
<button><a href="index.php">重新選擇</a></button>