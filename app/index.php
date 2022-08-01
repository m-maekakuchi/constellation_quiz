<?php
  require_once('QuizDao.php');
  session_start();

  $name         = "";
  $val_count    = 0;
  $success      = 0;
  $url          = 'https://fierce-ridge-82663.herokuapp.com/result.php';
  $dao          = null;
  
  try {
    //問題数を取得
    $dao = new QuizDao();
    $questions_num = $dao->selectQuestionNum();
    $contents = $dao->selectContents();

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
      for ($i = 1; $i <= $questions_num; $i++) {
        $choices_id = "choices_id".$i;
        if (!isset($_POST[$choices_id])) {
          $val_count++;
        } else {
          $_SESSION[$choices_id] = $_POST[$choices_id];
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
  } catch (PDOException $e) {
    die ("データベースエラー:".$e->getMessage());
  } catch (Exception $e) {
    echo $e->getMessage(), "例外発生"; 
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=”viewport” content=”width=device-width, initial-scale=1”>
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="css/style2.css">
</head>
<body>
  <div class="main">
    <div class="title">
      <h2>星座クイズ</h2>
    </div>
    <form method="post" action="index.php">
      <div class="name">
        <h4>名前を入力してください：</h4>
        <label class="label" for="name">
          <input
            id="name"
            type="text"
            name="name"
            value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ""; ?>"
          />
        </label>
      </div>
      <?php for ($i = 0; $i < $questions_num; $i++): ?>
        <h4>
          第<?php echo $i+1 ?>問　
          <?php
            echo $contents[$i]['QUESTION'];
          ?>
        </h4>
        <?php for ($j = 0; $j < count($contents[$i]['CHOICE_ID']); $j++): ?>
          <label>
            <input
              type="radio"
              name="choices_id<?php echo $contents[$i]['QUESTION_ID'] ?>"
              value="<?php echo $contents[$i]['CHOICE_ID'][$j] ?>"
              <?php if (
                        isset($_SESSION["choices_id".($i+1)])
                        &&
                        $_SESSION["choices_id".($i+1)] == $contents[$i]['CHOICE_ID'][$j]
                        )
                        echo "checked";
              ?>
            />
            <?php echo $contents[$i]['OPTIONS'][$j] ?>
          </label><br>
        <?php endfor ?>
      <?php endfor ?>
      <br>
      <div class="btn">
        <input type="submit" name="submit" class="submit" value="回答" />
        <input type="submit" name="submit" class="submit" value="リセット" />
      </div>
    </form>
  </div>
</body>
</html>