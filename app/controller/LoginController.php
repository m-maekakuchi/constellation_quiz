<?php

require_once("controller/Controller.php");
require_once('utilities/Validation.php');
require_once('common/Message.php');

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
    $error    = "";
		$email    = $params->email;
		$password = $params->password;
		$val      = new Validation();
		try {
			//ログインボタンが押された場合
			if ($params->submit === "ログイン") {
				//メールアドレスかパスワードが未入力の場合
				if (empty($params->email) || empty($params->password)) {
					$error = Message::$VAL_EMAIL_OR_PASS_EMPTY;
					$_SESSION['error'] = $error;
					return "view/login.php";
				//メールアドレスが正しく入力されていない場合
				} else if ($val->checklPattern(0, $params->email)) {
					$error = Message::$VAL_EMAIL_NOT_CORRECT;
					$_SESSION['error'] = $error;
					return "view/login.php";
				//メールアドレスとパスワードともに入力された場合
				} else {
					$_SESSION['loginStatus'] = "success";
					$loginModel = createModel("LoginModel");
					//メールアドレスが一致するアカウントがあるか判定
					$row = $loginModel->selectByEmail($params->email);
					//一致したらアカウント情報をセッションに登録
					if ($row) {
						//パスワードが一致するか判定
						if (password_verify($params->password, $row['password'])) {
							//ログインされたアカウント情報をセッションに登録
							$user = $loginModel->selectUserInfo($row['id']);
							$_SESSION['id']       = $user['id'];
							$_SESSION['name']     = $user['name'];
							$_SESSION['email']    = $user['email'];
							$_SESSION['address']  = $user['address'];
							$_SESSION['birthday'] = $user['birthday'];
							$_SESSION['tel']      = $user['tel'];
							$_SESSION['work']     = $user['work'];
							return "question";
						} else {
							$error = Message::$VAL_PASSWORD_WRONG;
							$_SESSION['error'] = $error;
							return "view/login.php";
						}
					//一致するメールアドレスがなかった場合
          } else {
						$error = Message::$VAL_EMAIL_NOT_REGIST;
						$_SESSION['error'] = $error;
						return "view/login.php";
					}
				}
			//「アカウント登録はこちら」ボタンが押された場合
			} else if ($params->submit === "アカウント登録はこちら") {
				return "registraion";
			//ログイン中のアカウントがある場合
			} else if (isset($_SESSION['id'])) {
				unset($_SESSION['answers']);
				return "question";
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