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
		var_dump($params);
		try {
			//ログイン状態が保たれていた場合
			if (isset($_SESSION['loginStatus'])) {
				//結果画面の再挑戦ボタンが押された場合は回答履歴を削除
				if (isset($params->tryAgain)) {
					unset($_SESSION['answers']);
				}
				//ユーザーの回答を保持するオブジェクト配列を取得
				$answers = [];
				if (isset($_SESSION['answers'])) {
					$answers = $_SESSION['answers'];
				}
				//ユーザーの回答を配列に格納
				if (isset($params->choices_id)) {
					array_push($answers, $params->choices_id);
					$_SESSION['answers'] = $answers;
					var_dump($_SESSION['answers']);
				}
				//最終問題の回答ボタンが押された場合、結果画面に遷移
				if (isset($params->last)) {
					return "result";
				//最終問題ではない場合
				} else {
					$question_id = 1;
					$questionModel = createModel("QuestionModel");

					//問題数を取得してセッションに登録
					if (isset($params->choices_id) === false) {
						$questions_num = $questionModel->selectCount();
						$_SESSION['questions_num'] = $questions_num;
					}
				
					//表示する問題が何問目かを算出
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