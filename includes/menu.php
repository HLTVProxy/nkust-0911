<?php
    $target = $_POST["target"];
    if ($target != null){
        header("Location: $target");
        exit;
    }
    // 在此建立一個結合陣列的陣列
    // $menuData是整個選單陣列
    // 中間的每個項目都是以結合陣列的形式儲存名稱和連結
    $menuData = array(
        "home" => array("name" => "回首頁",	"link" => "/mysite/nkust-0903/index.php"),
		"test01" => array("name" => "生日詢問表單", "link" => "/mysite/nkust-0903/test01"),
		"tets02" => array("name" => "嘴砲王留言板", "link" => "/mysite/nkust-0903/test02"),
        "test03" => array("name" => "我的播放清單", "link" => "/mysite/nkust-0903/test03"),
        "school" => array("name" => "國立雲林科技大學", "link" => "https://www.yuntech.edu.tw/")
    );
    
    // 製作表單
    echo "<form method='POST' action=index.php>";
    // 建下拉式選單
    echo "<label style='margin-left: 1%;'>選單：</label>";
    echo "<select name='target'>\n";
    // 用迴圈建選項
    foreach($menuData as $d){
        echo "<option value= $d[link]";
        // 送出後，固定選完後的選項
        if($target == $d["link"]){
            echo " selected>" . $d["name"] . "</option>\n";
        }else{
            echo ">" . $d["name"] . "</option>\n";
        }
    }
    echo "</select>";
    echo " <input type='submit' value='GOGO!'>";
    echo "</form>";
?>