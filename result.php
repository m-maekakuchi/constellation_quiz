<?php
  require_once('data.php');

  $name = "";
  $result = [];
  $url = "http://localhost/marie/quiz/index.php";
  $countCorrAns = 0;

  try {
    if(isset($_SERVER['HTTP_REFERER'])) {
      
      if(isset($_POST['name'])){
        $name = $_POST['name'];
        if ($name == "") {
          $name = "名無し";
        } 
      } 
      // else {
      //   $name = "isset==false";
      //   var_dump($name);
      // }

      for ($i=1; $i<=count($questions); $i++) {
        $ans = "answer".$i;
        $corrAns =  "correctAnswer".$i;
        if(isset($_POST[$ans])){
          if ($_POST[$ans] == $_POST[$corrAns]) {
            array_push($result, "正解です");
            $countCorrAns++;
          } else {
            array_push($result, "不正解です");
          }
        } else {
          array_push($result, "選択してください");
        }
      }
    } else {
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
  <h4><?php echo $name."さん、こんにちは"?></h4>
  <?php for ($i = 0; $i < count($questions); $i++): ?>
    <h3>第<?php echo $i+1 ?>問目</h3>
    <p><?php echo $result[$i] ?></p>
  <?php endfor ?>
    <h3><?php echo count($questions) ?>問中<?php echo $countCorrAns ?>個正解です</h3>
  <a href="index.php">戻る</a>
</body>
</html>