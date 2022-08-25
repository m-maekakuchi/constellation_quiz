<?php
  require_once('QuizDao.php');

  if (isset($_POST['submit']) && $_POST['submit'] == "csvファイル出力") {
    $fromDateTime = date('Y年m月d日 H時i分', strtotime(str_replace('T', ' ', $_POST['fromDateTime'])));
    $toDateTime = date('Y年m月d日 H時i分', strtotime(str_replace('T', ' ', $_POST['toDateTime'])));
    $dao = new QuizDao();
    $row = $dao->selectByTime($fromDateTime, $toDateTime);
    var_dump($row);
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="css/sample.css">
</head>
<body>
  <h2>結果の出力</h2>
  <form action="output.php" method="post">
    <input type="datetime-local" name="fromDateTime" value="2022-04-01T00:00" step="900" required />から<br>
    <input type="datetime-local" name="toDateTime" value="2022-04-01T00:00" step="900" required />まで<br>
    <br>
    <input type="submit" name="submit" value="csvファイル出力" />
  </form>
  <br>
  <a href="index.php">戻る</a>
</body>
</html>