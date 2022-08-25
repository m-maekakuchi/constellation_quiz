<?php

  $name = $_SESSION['name'];
  if (isset($_SESSION['question_error'])) {
    $error = $_SESSION['question_error'];
  }
  
  try {
    $questionDao = createDao("QuestionDao");
    $questions_num = $questionDao->selectCount();
    $contents = $questionDao->selectContents();
    $_SESSION['questions_num'] = $questions_num;
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
  <link rel="stylesheet" href="view/css/style.css">
</head>
<body class="question">
  <main>
    <div class="container">
      <div class="top-wrapper">
        <h2>星座クイズ</h2>
        <p><?php echo $name ?>さん、ようこそ！</p>
        <a href="" class="btn top">マイページ</a>
      </div>
      <div class="regist-wrapper">
      <?php if(isset($error)) echo "<p class='error'>{$error}</p>"; ?>
      <form action="index.php" method="post">
        <div class="regist-wrapper">
          <?php for ($i = 0; $i < $questions_num; $i++): ?>
            <h4>
              第<?php echo $i+1 ?>問　
              <?php
                echo $contents[$i]['QUESTION'];
              ?>
            </h4>
            <div class="choices">
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
            </div>
          <?php endfor ?>
        </div>
        <div class="form-submit">
          <input type="submit" name="submit" class="btn submit" value="回答する" />
          
          <input type="hidden" name="action" value="result">
        </div>
        <div class="form-submit">
          <input type="submit" name="submit" class="btn submit" value="リセット" />
          <input type="hidden" name="action" value="result">
        </div>
      </form>
    </div>
  </main>
</body>
</html>