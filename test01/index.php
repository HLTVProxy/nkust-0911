<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h2>0903練習1：生日詢問表單</h2>
    <hr>
    <?php include "../includes/menu.php"?>
    <hr>
    <form action="response.php" method="POST">
        <label>你的生日：民國</label>
        <select name="year" id="year">
            <?php
                for($i = 109 ; $i >= 40; $i--){
                    echo "<option value = '$i'>" . $i . "</option>";
                }
            ?>
        </select> 年
        <select name="month" id="month">
            <?php
                for($i = 1 ; $i <= 12; $i++){
                    echo "<option value = '$i'>" . $i . "</option>";
                }
            ?>
        </select> 月
        <select name="day" id="day">
            <?php
                for($i = 1 ; $i <= 31; $i++){
                    echo "<option value = '$i'>" . $i . "</option>";
                }
            ?>
        </select> 日
        <!-- <input type="date" name="birth" id="birth"> -->
        <input type="submit">
    </form>
    <hr>
    <?php include "../includes/footer.php"?>
</body>
</html>
