<?php
require_once("controller/Controller.php");
require_once('utilities/Validation.php');
require_once('common/Message.php');

class ManageQuizController extends Controller {
   /**
	 * 管理ページへ遷移する
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
				$errors = [];
				$manageQuizModel = createModel("ManageQuizModel");

				//追加ボタンが押された場合
				if (isset($params->addQuestion)) {
					$val = new Validation();

					//リロードによる重複登録の防止
					$arr = $manageQuizModel->selectSameQueNum($params->question);
					if ($arr['sameQueNum'] != 0) {
						return "view/management.php";
					}

					//問題文のバリデーションチェック
					if (isset($params->question)) {
						if ($val->checkEmpty($params->question)) {
							$errors['question'] = Message::$VAL_QUESTION_EMPTY;
						} else {
							$_SESSION['question'] = $params->question;
							$question = $_SESSION['question'];
						}
					}

					//選択肢1のバリデーションチェック
					if (isset($params->choice1)) {
						if ($val->checkEmpty($params->choice1)) {
							$errors['choice1'] = Message::$VAL_CHOICE1_EMPTY;
						} else {
							$_SESSION['choice1'] = $params->choice1;
							$choice1 = $_SESSION['choice1'];
						}
					}

					//選択肢2のバリデーションチェック
					if (isset($params->choice2)) {
						if ($val->checkEmpty($params->choice2)) {
							$errors['choice2'] = Message::$VAL_CHOICE2_EMPTY;
						} else {
							$_SESSION['choice2'] = $params->choice2;
							$choice2 = $_SESSION['choice2'];
						}
					}

					//選択肢3のバリデーションチェック
					if (isset($params->choice3)) {
						if ($val->checkEmpty($params->choice3)) {
							$errors['choice3'] = Message::$VAL_CHOICE3_EMPTY;
						} else {
							$_SESSION['choice3'] = $params->choice3;
							$choice3 = $_SESSION['choice3'];
						}
					}

					//選択肢4のバリデーションチェック
					if (isset($params->choice4)) {
						if ($val->checkEmpty($params->choice4)) {
							$errors['choice4'] = Message::$VAL_CHOICE4_EMPTY;
						} else {
							$_SESSION['choice4'] = $params->choice4;
							$choice4 = $_SESSION['choice4'];
						}
					}

					//正答のバリデーションチェック
					if (isset($params->corrChoice)) {
						if ($val->checkEmpty($params->corrChoice)) {
							$errors['corrChoice'] = Message::$VAL_CORRCHOICE_NOT_SELECT;
						} else {
							$_SESSION['corrChoice'] = $params->corrChoice;
							$corrChoice = $_SESSION['corrChoice'];
						}
					}

					//バリデーションチェックをしてエラーがない場合
					if (count($errors) == 0) {
						$result_flg;
						$choices = [$choice1, $choice2, $choice3, $choice4];
						//セッションにエラーメッセージが登録されていた場合は消去する
						if (isset($_SESSION['errors'])) {
							unset($_SESSION['errors']);
						}
						//問題文を登録
						$newQuestionsId = $manageQuizModel->insertQuestions($question);
						//選択肢を登録
						for ($i = 0; $i < 4; $i++) {
							if ($corrChoice == $i + 1) {
								$result_flg = 1;
							} else {
								$result_flg = 0;
							}
							$newChoicesId = $manageQuizModel->insertChoices($choices[$i], $result_flg, $newQuestionsId);
						}
						//answer_historyに新しい列を追加
						$insertRow = $manageQuizModel->insertColum($newQuestionsId);
						$_REQUEST['message'] = Message::$INSERT_QUESTION;
						//クイズの登録に成功したら以下のセッションオブジェクトを破棄
						unset($_SESSION['question']);
						unset($_SESSION['choice1']);
						unset($_SESSION['choice2']);
						unset($_SESSION['choice3']);
						unset($_SESSION['choice4']);
						unset($_SESSION['corrChoice']);
					//バリデーションチェックをしてエラーがある場合
					} else {
						$_SESSION['errors'] = $errors;
					}
				}
    		return "view/manageQuiz.php";
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