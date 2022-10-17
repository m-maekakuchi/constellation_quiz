<?php
	$question_id   = $_SESSION['question_id'];
	$title         = $_SESSION['title'];
	$choice_ids    = $_SESSION['choice_ids'];
	$choices       = $_SESSION['choices'];
	$questions_num = $_SESSION['questions_num'];
	$corr_ans      = $_SESSION['corr_ans'];
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
				<p><?php echo $_SESSION['name'] ?>さん、ようこそ！</p>
				<a href="index.php?action=mypage" class="btn top">マイページ</a>
				<a href="index.php?action=management" class="btn top">管理画面</a>
				<a href="index.php?action=logout" class="btn top">ログアウト</a>
			</div>
			<div class="regist-wrapper">
			<?php if(isset($error)) echo "<p class='error'>{$error}</p>"; ?>
			<form action="index.php" method="post" name="question">
				<div class="regist-wrapper">
					<h4>
						第<?php echo $question_id ?>問　
						<?php echo $title; ?>
					</h4>
					<?php for ($i = 0; $i < count($choices); $i++): ?>
						<label>
							<input
								type="radio"
								name="choices_id"
								value="<?php echo $choice_ids[$i] ?>"
								id="question<?php echo $i ?>"
							/>
							<?php echo $choices[$i] ?>
						</label><br>
					<?php endfor ?>
				</div>
				<div class="form-submit">
					<input type="submit" name="submit" class="btn submit" value="回答" onClick="return show_result();" >
					<input type="hidden" name="question_id" value="<?php echo $question_id ?>">
					<input type="hidden" name="action" value="question">
					<?php
						echo $question_id == $questions_num ?  "<input type=hidden name='last' value='last'>":"";
					?>
				</div>
			</form>
		</div>
	</main>
</body>
<script>
	function show_result() {
		const choiceRadio = document.getElementsByName('choices_id');
		const len = choiceRadio.length;
		let checkValue = 0;
		let corr_ans= <?php echo $corr_ans; ?>;
		for (let i = 0; i < len; i++) {
			if (choiceRadio.item(i).checked) {
				checkValue = choiceRadio.item(i).value;
			}
		}
		if(checkValue !== 0) {
			if (checkValue == corr_ans) {
						alert("正解！");
						corr_num++;
					} else {
						alert("不正解！");
					}
					return true;
		} else {
			alert("選択してください");
			return false;
		}
	};
</script>
</html>