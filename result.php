<?php
  require_once('Data.php');
  require_once('CheckAnswer.php');

  $name        = $_SESSION['name'];
  $userAnswers = [];

  try {
    //問題ページから遷移されてた場合
    if (isset($_SERVER['HTTP_REFERER'])) {
      for ($i=1; $i<=count(Data::$questions); $i++) {
        $userAns = "userAnswer".$i;
        array_push($userAnswers, $_SESSION[$userAns]);
      }
      $checkAnswer = new CheckAnswer();
      $resultList = $checkAnswer->check_ans($userAnswers, Data::$questions, Data::$correctAnswer);
    //問題ページから遷移されていない場合
    } else {
      // $_SESSION = [];
      // session_destroy();
      header('Location: http://localhost/marie/quiz/index.php');
      exit();
    }
  } catch (Exception $e) {
    echo $e->getMessage(), "例外発生"; 
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
  <h2>クイズの結果</h2>
  <h4>
    <?php
      if (isset($name)) {
        echo $name."さん、こんにちは";  
      }
    ?>
  </h4>
  <?php for ($i = 0; $i < count(Data::$questions); $i++): ?>
    <h3>第<?php echo $i+1 ?>問目</h3>
    <p>
      <?php
        if (isset($resultList)) {
          echo $resultList[0][$i];
        }
      ?>
    </p>
  <?php endfor ?>
    <h3><?php echo count(Data::$questions) ?>問中<?php echo $resultList[1] ?>問正解です</h3>
  <a href="index.php">戻る</a>
</body>
</html>