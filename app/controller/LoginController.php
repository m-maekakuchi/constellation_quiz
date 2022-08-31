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
		require_once('utilities/Validation.php');
    require_once('common/Message.php');

    $error = "";
		$email = $params->email;
		$password = $params->password;

		try {
			//ログインボタンが押された場合
			if ($params->submit === "ログイン") {
				//メールアドレスかパスワードが未入力の場合
				if (empty($params->email) || empty($params->password)) {
					$error = Message::$EMAIL_OR_PASS_EMPTY;
					$_SESSION['error'] = $error;
					return "view/login.php";
				//メールアドレスとパスワードともに入力された場合
				} else {
					$_SESSION['loginStatus'] = "success";
					$loginModel = createModel("LoginModel");
					//メールアドレスが一致するアカウントがあるか確認
					$row = $loginModel->selectByEmail($params->email);
					//一致したらアカウント情報をセッションに登録
					if ($row) {
						if (password_verify($params->password, $row['password'])) {
							$loginModel->selectUserInfo($row['id']);
							return "question";
						} else {
							$error = Message::$PASSWORD_WRONG;
							$_SESSION['error'] = $error;
							return "view/login.php";
						}
          } else {
						$error = Message::$EMAIL_NOT_REGIST;
						$_SESSION['error'] = $error;
						return "view/login.php";
					}
				}
			} else if ($params->submit === "アカウント登録はこちら") {
				return "registraion";
			} else {
				$_SESSION = [];
				session_destroy();
				return "view/login.php";
			}
		} catch (PDOException $e) {
			die ("データベースエラー:".$e->getMessage());
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}
	}
}