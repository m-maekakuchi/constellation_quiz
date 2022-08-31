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
		var_dump(16);
		if(isset($_SESSION['loginStatus'])) {
			var_dump(1);
			exit;
			return "view/question.php";
		}

		// トップページのパスを返す
		$email = $params->email;
		$password = $params->password;


		if ($email != "" && $password != "") {
			//データベース省略
			if ($password === "1234") {
				$_SESSION['loginStatus'] = "success";
				return "question";
			} else {
				return "view/login.php";
			}
		} else {
			return "view/login.php";
		}
	}
}