<?php

//変数を作る

$name = $_POST["name"];
$blood = $_POST["blood"];
$sign = $_POST["sign"];
$shay = $_POST["shay"];


$data = [
    "name" =>$name,
    "blood"=>$blood,
    "sign" =>$sign,
    "shay" =>$shay
];
$jsonData = json_encode($data,JSON_UNESCAPED_UNICODE);

// echo $jsonData;

//file書き込み
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = fopen("data.txt", "a");
    fwrite($file, $jsonData."\n");
    fclose($file);

    header("Location:read.php");
    exit;
}
