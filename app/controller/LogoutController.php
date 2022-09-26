<?php

require_once("controller/Controller.php");

class LogoutController extends Controller {
	/**
	 * ログアウトしてログインページへ遷移する
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
	public function action($params, $model) {
    //ログアウトボタンが押された場合
		try {
      $_SESSION = [];
      session_destroy();
      return "view/login.php";
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}
	}
}