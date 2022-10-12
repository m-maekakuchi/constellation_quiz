<?php
require_once("controller/Controller.php");

class QuestionController extends Controller {
  /**
	 * クイズページへ遷移する
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
	public function action($params, $model) {
		try {
			//ログイン状態が保たれていた場合
			if (isset($_SESSION['loginStatus'])) {
				$questionModel = createModel("QuestionModel");
				//結果画面の再挑戦ボタンが押された場合は回答履歴を削除
				if (isset($params->tryAgain)) {
					unset($_SESSION['answers']);
					unset($_SESSION['resultArrived']);
				//ログイン後（第1問目）の場合問題数をセッションに登録
				} else if (isset($params->loginSubmit)) {
					$questions_num = $questionModel->selectCount();
					$_SESSION['questions_num'] = $questions_num;
				}
				
				//ユーザーの回答を保持するオブジェクト配列を取得
				$answers = [];
				if (isset($_SESSION['answers'])) {
					$answers = $_SESSION['answers'];
				}
				
				if (isset($params->choices_id)) {
					//リロードによるフォームの多重送信の防止
					//選択肢の番号が同じであれば以下のコードを飛ばす
					if (isset($_SESSION['choices_id']) && $_SESSION['choices_id'] === $params->choices_id) {
						if (isset($params->last)) {
							return "result";
						} else {
							return "view/question.php";
						}
					}
					$_SESSION['choices_id'] = $params->choices_id;

					//ユーザーの回答を配列に格納
					array_push($answers, $params->choices_id);
					$_SESSION['answers'] = $answers;

					var_dump($_SESSION['answers']);
					echo "<br>";
				}

				//最終問題の回答ボタンが押された場合、結果画面に遷移
				if (isset($params->last)) {
					return "result";
				//最終問題ではない場合
				} else {
					//表示する問題が何問目かを算出
					$question_id = 1;
					if (isset($_POST['question_id'])) {
						if ($_POST['question_id'] < $_SESSION['questions_num']) {
							$question_id = $_POST['question_id'] + 1;
						} else {
							$question_id = $_POST['question_id'];
						}
					}
					$_SESSION['question_id'] = $question_id;

					//表示する問題の情報をデータベースから取得してセッションに登録
					$contents = $questionModel->selectContents($question_id);
					$_SESSION['title'] = $contents['title'];
					$_SESSION['choices'] = $contents['choices'];
					$_SESSION['choice_ids'] = $contents['choice_ids'];
					//問題の正答をセッションに登録
					$corr_ans = $questionModel->selectByFlg($question_id);
					$_SESSION['corr_ans'] = $corr_ans['id'];

					return "view/question.php";
				}
			} else {
				return "login";
			}
		} catch (PDOException $e) {
			die ("データベースエラー:".$e->getMessage());
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}
  }
}