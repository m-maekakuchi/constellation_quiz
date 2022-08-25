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
		$answers = [];
		if (isset($_SESSION['answers'])) {
			$answers = $_SESSION['answers'];
		}
		array_push($answers, $params->choices_id);
		$_SESSION['answers'] = $answers;

		var_dump($answers);
    return "view/question.php";
  }
}