<?php
require_once("controller/Controller.php");

class CompleteController extends Controller {
   /**
	 * アカウント登録画面へ遷移する
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
  public function action($params, $model) {
    return "view/complete.php";
  }
}