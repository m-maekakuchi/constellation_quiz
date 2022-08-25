<?php

require_once("controller/Controller.php");

class RegistCompleteController extends Controller {
	/**
	 * アカウント登録完了ページへ遷移する
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
	
		$success   = 0;
		$errors    = [];
		$year      = "";
		$month     = "";
		$day       = "";
		$tel       = null;
		$addr      = null;
		$birthday  = null;
		$work      = null;
	
		try {
			$usersDao        = createDao("UsersDao");
			$user_detailDao  = createDao("User_detailDao");
			$val             = new Validation();

			//入力必須の名前のバリデーションチェック
			if ($val->checkEmpty($params->name)) {
				$errors['name'] = Message::$NAME_EMPTY;
			} else {
				$_SESSION['name'] = $params->name;
				$name = $_SESSION['name'];
			}

			//入力必須のメールアドレスのバリデーションチェック
			if ($val->checkEmpty($params->email)) {
				$errors['email'] = Message::$EMAIL_EMPTY;
			} else if ($val->checklPattern(0, $params->email)) {
				$errors['email'] = Message::$EMAIL_NOT_CORRECT;
			} else if ($usersDao->selectByEmail($params->email) != false) {
				$errors['email'] = Message::$SAME_EMAIL;
			} else {
				$_SESSION['email'] = $params->email;
				$email = $_SESSION['email'];
			}

			//入力必須のパスワードのバリデーションチェック
			if ($val->checkEmpty($params->password)) {
				$errors['password'] = Message::$PASS_EMPTY;
			} else if ($val->checkEmpty($params->password_confirm)) {
				$errors['password_confirm'] = Message::$PASS_CONFIRM_EMPTY;
			} else if ($val->checklPattern(1, $params->password)) {
				$errors['password'] = Message::$PASS_NOT_CORRECT;
			} else if ($params->password !== $params->password_confirm) {
				$errors['password_confirm'] = Message::$PASS_NOT_EQUAL;
			} else {
				$password = $params->password;
			}

			//入力任意の電話番号のバリデーションチェック
			if (!$val->checkEmpty($params->tel)) {
				if ($val->checklPattern(2, $params->tel)) {
					$errors['tel'] =  Message::$TEL_NO_CORRECT;
				} else {
					$_SESSION['tel'] = $params->tel;
					$tel = $_SESSION['tel'];
				}
			}

			if (!$val->checkEmpty($params->address)) {
				$_SESSION['address'] = $params->address;
				$addr = $_SESSION['address'];
			}

			if (!$val->checkEmpty($params->work)) {
				$_SESSION['work'] = $params->work;
				$work = $_SESSION['work'];
			}

			if (!$val->checkEmpty($params->year)) {
				$_SESSION['year'] = $params->year;
				$year = $_SESSION['year'];
			}

			if (!$val->checkEmpty($params->month)) {
				$_SESSION['month'] = $params->month;
				$month = $_SESSION['month'];
			}

			if (!$val->checkEmpty($params->day)) {
				$_SESSION['day'] = $params->day;
				$day = $_SESSION['day'];
			}

			if ($year != "" && $month != "" && $day != "") {
				$birthday = "{$year}/{$month}/{$day}";
			}

			if (count($errors) == $success) {
				$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
				$newUsersId = $usersDao->insert($email, $hashed_pass);
				$newUser_detailId = $user_detailDao->insert($name, $addr, $birthday, $tel, $work, $newUsersId);
				return "view/complete.php";
			} else {
				$_SESSION['errors'] = $errors;
				return "view/registration.php";
			}

		} catch (PDOException $e) {
			die ("データベースエラー:".$e->getMessage());
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}
	 }
}