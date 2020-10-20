<?php // 區域變數：所有在函數裡面定義的變數，或使用的變數
function getCounter($target) {
    // 宣告我要使用的$conn，是外面的那個全域變數
    global $conn;
    $sql = "SELECT * FROM counter WHERE name = '$target'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $value = $row["value"];
    }else{
        $value = 0;
    }
    echo "參觀人次：". $value . "人<br>";
    $value++;
    $update = "UPDATE counter SET value = '$value' where name = '$target'";
    $conn->query(($update));      
}

function get_Vnumbers($id){
    global $conn;
    // 計算有幾支影片(符合條件的有幾筆)
    $sql = "SELECT COUNT(*) AS numbers FROM video WHERE pid = '$id'";
    $result = $conn->query($sql);
    // 檢查裡面的影片樹是否大於零
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $numbers = $row["numbers"];
    }else{
        $numbers = 0;
    }
    return $numbers;
}
?>