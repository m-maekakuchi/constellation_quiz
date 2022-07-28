<?php
  require_once('QuizDao.php');
  session_start();
  
  $name         = $_SESSION['name'];
  $choices_id1  = $_SESSION['choices_id1'];
  $choices_id2  = $_SESSION['choices_id2'];
  $choices_id3  = $_SESSION['choices_id3'];
  $results      = [];
  $dao          = null;
  $countCorrAns = 0;
  $TRUE         = 0;

  try {
    //問題ページ画面からの遷移の場合
    if (isset($_SERVER['HTTP_REFERER'])) {
      $dao = new QuizDao();
      $row = $dao->insertUserAnswer($name, $choices_id1, $choices_id2, $choices_id3);
      $rows = $dao->checkAnswer($choices_id1
                                , $choices_id2
                                , $choices_id3);
      for ($i = 0; $i < 3; $i++) {
        if ($rows[$i]['result_flg'] == $TRUE) {
          $results[$i] = "正解！";
          $countCorrAns++;
        } else {
          $results[$i] = "不正解！";
        }
      }
    //問題ページ以外からの画面遷移の場合
    } else {
      $_SESSION = [];
      session_destroy();
      header('Location: http://localhost/marie/quiz/app/index.php');
      exit();
    }
  } catch (PDOException $e) {
    die ("データベースエラー:".$e->getMessage());
  } catch (Exception $e) {
    echo $e->getMessage(), "例外発生"; 
  } finally {
    $dao = null;
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <h2>クイズの結果</h2>
  <h4>
    <?php
      if (isset($name)) {
        echo "${name}さん、こんにちは";  
      }
    ?>
  </h4>
  <?php for ($i = 0; $i < count($results); $i++): ?>
    <h3>第<?php echo $i+1 ?>問目</h3>
    <p>
      <?php
        if (isset($results)) {
          echo $results[$i];
        }
      ?>
    </p>
  <?php endfor ?>
  <h3><?php echo count($results) ?>問中<?php echo $countCorrAns ?>問正解です</h3>
  <a href="index.php">戻る</a><br>
  <a href="output.php">結果を出力</a>
</body>
</html>