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
$data1 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
$data2 = [0, 0];

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
        if ($item && isset($item['sign'])) {
            switch ($item['sign']) {
                case 'おひつじ座':
                    $data1[0]++;
                    break;
                case 'おうし座':
                    $data1[1]++;
                    break;
                case 'ふたご座':
                    $data1[2]++;
                    break;
                case 'かに座':
                    $data1[3]++;
                    break;
                case 'しし座':
                    $data1[4]++;
                    break;
                case 'おとめ座':
                    $data1[5]++;
                    break;
                case 'てんびん座':
                    $data1[6]++;
                    break;
                case 'さそり座':
                    $data1[7]++;
                    break;
                case 'いて座':
                    $data1[8]++;
                    break;
                case 'やぎ座':
                    $data1[9]++;
                    break;
                case 'みずがめ座':
                    $data1[10]++;
                    break;
                case 'うお座':
                    $data1[11]++;
                    break;
            }
        }
        if ($item && isset($item['shay'])) {
            switch ($item['shay']) {
                case 'はい':
                    $data2[0]++;
                    break;
                case 'いいえ':
                    $data2[1]++;
                    break;
            }
        }
    }
    fclose($file);
} else {
    echo 'データの読み込みエラー';
}
$php_data = json_encode($data);
$php_data1 = json_encode($data1);
$php_data2 = json_encode($data2);
// print_r($data);
// $test =[4,6,5,2];
// $php_test = json_encode($test);
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
    <div style="width: 300px; height: 500px;">
        <h2 style="text-align: center;">星座</h2>
        <canvas id="sign_chart"></canvas>
    </div>
    <div style="width: 300px; height: 500px;">
        <h2 style="text-align: center;">人見知り</h2>
        <canvas id="shay_chart"></canvas>
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
        const data = <?php echo $php_data; ?>;
        console.log(data);

        const ctx = document.querySelector('#blood_chart').getContext('2d');
        const cha = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["A", "B", "O", "AB"],
                datasets: [{
                    label: '# of Votes',
                    data: data,
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
        const data1= <?php echo $php_data1; ?>;
        console.log(data1);
        const ctx1 = document.querySelector('#sign_chart').getContext('2d');
        const cha1 = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ["おひつじ座", "おうし座", "ふたご座", "かに座","しし座","おとめ座","てんびん座","さそり座","いて座","やぎ座","みずがめ座","うお座"],
                datasets: [{
                    label: '# of Votes',
                    data: data1,
                    backgroundColor: [
                        'rgb(255, 99, 132)', // ピンク
                        'rgb(54, 162, 235)', // 水色
                        'rgb(255, 205, 86)', // イエロー
                        'rgb(75, 192, 192)', // ミントグリーン
                        'rgb(255, 159, 64)', // オレンジ
                        'rgb(153, 102, 255)', // ラベンダー
                        'rgb(255, 99, 230)', // パープル
                        'rgb(100, 181, 246)', // スカイブルー
                        'rgb(200, 200, 100)', // ライトイエロー
                        'rgb(119, 221, 119)', // ライトグリーン
                        'rgb(255, 140, 105)', // ライトコーラル
                        'rgb(176, 224, 230)' // パウダーブルー
                    ],
                    hoverOffset: 12
                }]
            },
        });

        const data2 = <?php echo $php_data2; ?>;
        console.log(data2);
        const ctx2 = document.querySelector('#shay_chart').getContext('2d');
        const cha2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ["はい", "いいえ"],
                datasets: [{
                    label: '# of Votes',
                    data: data2,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                    ],
                    hoverOffset: 2
                }]
            },
        });
    </script>
</body>

</html>