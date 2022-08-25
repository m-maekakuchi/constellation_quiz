<?php

require_once("controller/Controller.php");

class LoginController extends Controller {
	/**
	 * ログインページへ遷移する
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
	public function action($params, $model) {
		// トップページのパスを返す
		return "view/login.php";
	}
}