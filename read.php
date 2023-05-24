<?php
//ファイルの場所を示す
$filepath = "data.txt";
//ファイルポインタはファイル内の現在の位置を指す、読み取りや書き込みの位置を管理する
//nullはファイルが開かれていない状態
$fp = null;
$list = [];

//
if (!$fp = fopen($filepath, "r")) {
    echo "ファイルが開けませんでした。";
} else if (flock($fp, LOCK_SH) == false) {
    echo "ファイルがロックできませんでした。";
}

$data = [0, 0, 0, 0];

if ($file = fopen($filepath, 'r')) {
    while (!feof($file)) {
        $line = fgets($file);
        $item = json_decode($line, true);
        if ($item && isset($item['blood'])) {
            switch ($item['blood']) {
                case 'A':
                    $data[0]++;
                    break;
                case 'B':
                    $data[1]++;
                    break;
                case 'O':
                    $data[2]++;
                    break;
                case 'AB':
                    $data[3]++;
                    break;
            }
        }
    }
    fclose($file);
} else {
    echo 'データの読み込みエラー';
}
$php_data = json_encode($data);
// print_r($data);
// $test =[4,6,5,2];
// $php_test = json_encode($test);
?>
<?php $data2 = [0, 0];

if ($file = fopen($filepath, 'r')) {
    while (!feof($file)) {
        $line = fgets($file);
        $item = json_decode($line, true);
        if ($item && isset($item['shay'])) {
            switch ($item['shay']) {
                case 'はい':
                    $data[0]++;
                    break;
                case 'いいえ':
                    $data[1]++;
                    break;
            }
        }
    }
    fclose($file);
} else {
    echo 'データの読み込みエラー';
}
$php_data2 = json_encode($data2);
?>



<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>結果</title>
    <style>
        td {
            width: 200px;
        }
 
     

    </style>
</head>

<body>
<div style="width: 300px; height: 500px;">
<h2 style="text-align: center;">血液型</h2>
    <canvas id="blood_chart"></canvas>
</div>
    <table border="1">
        <tr>
            <td>お名前</td>
            <td>血液型</td>
            <td>星座</td>
            <td>人見知り</td>
        </tr>
        <!-- もしファイルパスがnullじゃない＝ファイルが開けていれば以下の処理を実行-->
        <?php if ($fp != null) : ?>
            <!-- ファイルの終端まで読み込むと、fpの値がnullになる＝falseになる＝ループから抜ける -->
            <?php while ($data = fgetcsv($fp)) : ?>
                <tr>
                    <td><?php echo $data[0]; ?></td>
                    <td><?php echo $data[1]; ?></td>
                    <td><?php echo $data[2]; ?></td>
                    <td><?= $data[3] ?></td>
                </tr>

            <?php endwhile; ?>
            <!-- {} ブロックの代わりに endif; で終了。（代替構文、使うかは好みによる） -->
        <?php endif; ?>
    </table>

 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
    <!-- <script src="index.js"></script> -->
    <script>
        const data =<?php echo $php_data;?>;
        console.log(data);
  
        const ctx = document.querySelector('#blood_chart').getContext('2d');
        const cha = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["A", "B", "O", "AB"],
                datasets: [{
                    label: '# of Votes',
                    data:data,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)'
                    ],
                    hoverOffset: 4
                }]
            },
        });

        
    </script>
</body>

</html>