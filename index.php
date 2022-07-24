<?php
  require_once('data.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="css/sample.css">
</head>
<body>
  <form method="post" action="result.php">
    <p>名前を入力してください</p>
    <input type="text" name="name">
    <?php for($i=0; $i<count($questions); $i++): ?>
      <h4>第<?php echo $i+1 ?>問　<?php echo $questions[$i]->getTitle() ?></h4>
      <?php foreach ($questions[$i]->getOptions() as $value): ?>
        <label><input type="radio" name="answer<?php echo $i+1 ?>" value="<?php echo $value ?>"><?php echo $value ?></label><br>
      <?php endforeach ?>
      <input type="hidden" name="correctAnswer<?php echo $i+1 ?>" value="<?php echo $questions[$i]->getCorrectAnswer() ?>">
    <?php endfor ?>
    <br>
    <input type="submit" value="回答">
  </form>
</body>
</html>