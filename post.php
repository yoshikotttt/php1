<!-- 入力画面 -->
<html>

<head>
  <meta charset="utf-8">
  <title>入力画面</title>
  <style>
    .box0{
      display: flex;
      flex-direction: column;
    }
    .box {
      margin: 20px;
    }

  </style>
</head>

<body>

  <h1>アンケート</h1>
  <div class="box0">
    <div class="box">
      <form action="write.php" method="post">
        名前：<input type="text" name="name">
    </div>
    <div class="box">
    血液型：<input type="radio" name="blood" value="A">A
    <input type="radio" name="blood" value="B">B
    <input type="radio" name="blood" value="O">O
    <input type="radio" name="blood" value="AB">AB
    </div>
    <div class="box">
    星座：<select name="sign">
      <option value="おひつじ座">おひつじ座</option>
      <option value="おうし座">おうし座</option>
      <option value="ふたご座">ふたご座</option>
      <option value="かに座">かに座</option>
      <option value="しし座">しし座</option>
      <option value="おとめ座">おとめ座</option>
      <option value="てんびん座">てんびん座</option>
      <option value="さそり座">さそり座</option>
      <option value="いて座">いて座</option>
      <option value="やぎ座">やぎ座</option>
      <option value="みずがめ座">みずがめ座</option>
      <option value="うお座">うお座</option>
    </select>
    </div>
    <div class="box">
    人見知り：<input type="radio" name="shay" value="はい">はい
    <input type="radio" name="shay" value="いいえ">いいえ
    <div class="box">
    <input type="submit" value="送信">
    </div>
    </form>
    </div>
  </div>
  <!-- <ul>
<li><a href="input.php">戻る</a></li>
</ul> -->
</body>

</html>