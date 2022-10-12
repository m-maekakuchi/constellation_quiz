<?php
  $questions_num = $_SESSION['questions_num'];
	$corr_num      = $_SESSION['corr_num']
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
					<?php echo $_SESSION['name'] ?>さんは、<?php echo $questions_num ?>問中<?php echo $corr_num ?>問正解です!
				</h4>
				<a href="index.php?action=question&tryAgain=tryAgain" class="btn submit">再挑戦</a>
				<a href="index.php?action=logout" class="btn submit">ログアウト</a>
      </div>
		</div>
	</main>
</body>
</html>