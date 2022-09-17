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
		//ログイン状態が保たれていた場合
    if (isset($_SESSION['loginStatus'])) {
			if (isset($params->last)) {
				return "result";
			} else {
				//ユーザーの回答を保持するオブジェクト配列を取得
				$answers = [];
				if (isset($_SESSION['answers'])) {
					$answers = $_SESSION['answers'];
				}
				//ユーザーの回答を配列に格納
				if (isset($params->choices_id)) {
					array_push($answers, $params->choices_id);
					$_SESSION['answers'] = $answers;
				}

				try {
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
					$questionModel->selectContents($question_id);
					//問題の正答をセッションに登録
					$corr_ans = $questionModel->selectByFlg($question_id);
					$_SESSION['corr_ans'] = $corr_ans['id'];
				} catch (PDOException $e) {
					die ("データベースエラー:".$e->getMessage());
				} catch (Exception $e) {
					echo $e->getMessage(), "例外発生"; 
				}
				return "view/question.php";
			}
		} else {
			return "view/login.php";
		}
  }
}