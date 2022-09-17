<?php
  $questions_num = $_SESSION['questions_num'];
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
				<p><?php echo $_SESSION['name'] ?>さんの結果</p>
				<a href="index.php?action=mypage" class="btn top">マイページ</a>
			</div>
			<div class="form-wrapper">
        <h4>
          <?php echo $_SESSION['name'] ?>さんは、<?php echo $questions_num ?>問中●問正解です!
        </h4>
      </div>
		</div>
	</main>
</body>
</html>