<?php
  var_dump($_SESSION['action']);
  var_dump($_SESSION['answers']);
  // $users_id      = $_SESSION['loginId'];
  $name          = $_SESSION['name'];
  $questions_num = $_SESSION['questions_num'];

  // $results       = [];
  // $countCorrAns  = 0;
  // $TRUE          = 1;

  // try {
  //   //問題ページ画面からの遷移の場合
  //   if (isset($_SERVER['HTTP_REFERER'])) {
  //     $answer_historyDao = createDao("Answer_historyDao");
  //     $row = $answer_historyDao->insert($users_id, $choices_id1, $choices_id2, $choices_id3, $choices_id4, $choices_id5, $choices_id6, $choices_id7, $choices_id8, $choices_id9, $choices_id10);
  //     $rows = $answer_historyDao->checkAnswer($choices_id1, $choices_id2, $choices_id3, $choices_id4, $choices_id5, $choices_id6, $choices_id7, $choices_id8, $choices_id9, $choices_id10);
  //     for ($i = 0; $i < $questions_num; $i++) {
  //       if ($rows[$i]['result_flg'] == $TRUE) {
  //         $results[$i] = "正解！";
  //         $countCorrAns++;
  //       } else {
  //         $results[$i] = "不正解！";
  //       }
  //     }
  //   //問題ページ以外からの画面遷移の場合
  //   } else {
  //     $_SESSION = [];
  //     session_destroy();
  //     header('Location: http://localhost/marie/quiz/app/question.php');
  //     exit();
  //   }
  // } catch (PDOException $e) {
  //   die ("データベースエラー:".$e->getMessage());
  // } catch (Exception $e) {
  //   echo $e->getMessage(), "例外発生"; 
  // }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=”viewport” content=”width=device-width, initial-scale=1”>
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main>
    <div class="container">
      <div class="top-wrapper">
        <h2>星座クイズ</h2>
        <p><?php echo $name ?>さんの結果</p>
				<a href="" class="btn top">マイページ</a>
      </div>
      <div class="form-wrapper">
        <h4><?php echo $name ?>さんは、<?php echo $questions_num ?>問中●問正解です!</h4>
      </div>
      <div class = "btn">
        <a href="question.php" class="submit">再挑戦</a><br>
      </div>
    </div>
  </main>
</body>
</html>