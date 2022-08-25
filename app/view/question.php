<?php
	var_dump($_SESSION['action']);
	$correct_answers = $_SESSION['correct_answers'];
  
	if ($_SESSION['action'] == 'loginComplete' || $_SESSION['action'] == 'question') {
		$id = 1;
		if (isset($_POST['question_id'])) {
			if ($_POST['question_id'] < $_SESSION['questions_num']) {
				$id = $_POST['question_id'] + 1;
			} else {
				$id = $_POST['question_id'];
			}
		}
		try {
			$questionDao = createDao("QuestionDao");
			$contents = $questionDao->selectContents($id);

			$title = $contents[0]['QUESTION'];
			$choices = [];
			for ($i = 0; $i < count($contents[0]['OPTIONS']); $i++) {
				$choice = $contents[0]['OPTIONS'][$i];
				array_push($choices, $choice);
			}
			$question_id = "choices_id".$contents[0]['QUESTION_ID'];
		} catch (PDOException $e) {
			die ("データベースエラー:".$e->getMessage());
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}
	}
	$answer = $correct_answers[$contents[0]['QUESTION_ID'] - 1]['id'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name=”viewport” content=”width=device-width, initial-scale=1”>
	<title>簡易星座クイズプログラム</title>
	<link rel="stylesheet" href="view/css/style.css">
</head>
<script>
	function show_result() {
		let ans= <?php echo json_encode($answer); ?>;
			alert(ans);
		if (question.choices_id.value ) {
			alert("正解！");
		} else {
			alert("不正解！");
		}
		return true;
	}
</script>
<body class="question">
	<main>
		<div class="container">
			<div class="top-wrapper">
				<h2>星座クイズ</h2>
				<p><?php echo $_SESSION['name'] ?>さん、ようこそ！</p>
				<a href="" class="btn top">マイページ</a>
			</div>
			<div class="regist-wrapper">
			<?php if(isset($error)) echo "<p class='error'>{$error}</p>"; ?>
			<form action="index.php" method="post" name="question">
				<div class="regist-wrapper">
					<h4>
						第<?php echo $id ?>問　
						<?php echo $title; ?>
					</h4>
					<?php for ($i = 0; $i < count($choices); $i++): ?>
						<label>
							<input
								type="radio"
								name="choices_id"
								value="<?php echo $contents[0]['CHOICE_ID'][$i] ?>"
								id="question"
							/>
							<?php echo $choices[$i] ?>
						</label><br>
					<?php endfor ?>
				</div>
				<div class="form-submit">
					<input type="submit" name="submit" class="btn submit" value="回答" onClick="return show_result();" >
					<input type="hidden" name="question_id" value="<?php echo $contents[0]['QUESTION_ID'] ?>">
					<input type="hidden" name="action" value="question">
					<?php
						if (
								isset($_SESSION['answers'])
								&&
								(count($_SESSION['answers']) == $_SESSION['questions_num'])
								) {
							echo "<input type='submit' name='submit' class='btn submit' value='結果' />";
							echo "<input type='hidden' name='action' value='result'>";
						}
					?>
				</div>
			</form>
		</div>
	</main>
</body>
</html>