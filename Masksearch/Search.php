<?php
$city = $_GET["city"];
$area = $_GET["area"];
$data = file_get_contents("https://data.nhi.gov.tw/resource/mask/maskdata.csv"); // 開啟檔案 (開啟後讀入的檔案型態是Array)
$Masklist = array();
$qstr = explode("\n", $data);
// 切割字串
for ($i=0; $i<count($qstr)-1; $i++) {    // count就是length
    array_push($Masklist, explode(",", $qstr[$i]));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="77.css">
</head>
<body>
    <div id="result">
        <?php
            echo '<table>';
            echo '<tr><th>'.$Masklist[0][0].'</th>';
            echo '<th>'.$Masklist[0][1].'</th>';
            echo '<th>'.$Masklist[0][2].'</th>';
            echo '<th>'.$Masklist[0][3].'</th>';
            echo '<th>'.$Masklist[0][4].'</th>';
            echo '<th>'.$Masklist[0][5].'</th>';
            echo '<th>'.$Masklist[0][6].'</th></tr>';
            $count = 0;
            foreach ($Masklist as $key => $value) {
                // strpos(str1, str2) str2 位於 str1 中的第幾個位置 如果沒找到就回傳false
                if (strpos($value[2], "{$city}") == 0 && strpos($value[2], "{$area}") > 0) {
                    echo '<tr><td>'.$value[0].'</td>';
                    echo '<td>'.$value[1].'</td>';
                    echo '<td>'.$value[2].'</td>';
                    echo '<td>'.$value[3].'</td>';
                    echo '<td>'.$value[4].'</td>';
                    echo '<td>'.$value[5].'</td>';
                    echo '<td>'.$value[6].'</td></tr>';
                    $count += 1;
                }
            }
            if ($count == 0) {
                echo "查無資料";
            }
            echo '</table>';
        ?>
    </div>
</body>
</html>