<?php
  require_once('Data.php');
  session_start();

  $name         = "";
  $countCorrAns = 0;
  $val_count    = 0;
  $success      = 0;
  $url          = 'http://localhost/marie/quiz/result.php';

  try {
    //回答ボタンが押された場合
    if (isset($_POST['submit']) && $_POST['submit'] == "回答") {
      //名前が入力されているかの判定
      if (isset($_POST['name'])) {
        $name = $_POST['name'];
        if ($name == "") {
          $val_count++;
        } else {
          $_SESSION['name'] = $name;
        }
      }
      //選択されていない問題があるかの判定
      for ($i = 1; $i <= count(Data::$questions); $i++) {
        $userAns = "userAnswer".$i;
        if (!isset($_POST[$userAns])) {
          $val_count++;
        } else {
          $_SESSION[$userAns] = $_POST[$userAns];
        }
      }
      //全て入力・選択された場合
      if ($val_count == $success) {
        header('Location: '.$url);
        exit();
      }
    //リセットボタンが押された場合と結果ページから戻ってきた場合
    } elseif ((isset($_POST['submit']) && $_POST['submit'] == "リセット")
              ||
              (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $url)
              ) {
                  $_SESSION = [];
                  session_destroy();
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
  <h2>星座クイズ</h2>
  <form method="post" action="index.php">
    <p>名前を入力してください</p>
    <input 
      type="text"
      name="name"
      value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ""; ?>"
    />
    <?php for ($i = 0; $i < count(Data::$questions); $i++): ?>
      <h4>第<?php echo $i+1 ?>問　<?php echo Data::$questions[$i][0] ?></h4>
      <?php for ($j = 0; $j < count(Data::$questions[$i][1]); $j++): ?>
        <label>
          <input
            type="radio"
            name="userAnswer<?php echo $i+1 ?>"
            value="<?php echo $j ?>"
            <?php if (
                      isset($_SESSION["userAnswer".($i+1)])
                      &&
                      $_SESSION["userAnswer".($i+1)] == $j
                      ) {
                        echo "checked";
                  }
            ?>
          />
          <?php echo Data::$questions[$i][1][$j] ?>
        </label><br>
      <?php endfor ?>
    <?php endfor ?>
    <br>
    <input type="submit" name="submit" value="回答">
    <input type="submit" name="submit" value="リセット">
  </form>
</body>
</html>