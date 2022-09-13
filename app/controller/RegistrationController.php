<?php
require_once("controller/Controller.php");
require_once('utilities/Form.php');
require_once('utilities/Validation.php');
require_once('common/Message.php');

class RegistrationController extends Controller {
	/**
	 * 会員登録画面へ遷移する
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
	public function action($params, $model) {
		try {
			$registrationModel = createModel("RegistrationModel");
			//ログイン画面で「アカウント登録はこちら」ボタンが押された場合
			if ($params->action === "registration" && isset($params->submit) === false) {
				//フォームの選択肢を生成し、セッションに登録
				$form    = new Form();
				$works   = $registrationModel->selectWorks();
				$address = $registrationModel->selectAddress();
				$years   = $form->makeItems(1950, 2020);
				$months  = $form->makeItems(1, 12);
				$days    = $form->makeItems(1, 31);
				$_SESSION['addresss'] = $address;
				$_SESSION['works']    = $works;
				$_SESSION['years']    = $years;
				$_SESSION['months']   = $months;
				$_SESSION['days']     = $days;
				return "view/registration.php";

			//登録するボタンが押された場合
			} else if (isset($params->submit) && $params->submit === '登録する') {
				try {
					$errors   = [];
					$year     = "";
					$month    = "";
					$day      = "";
					$tel      = null;
					$addr     = null;
					$birthday = null;
					$work     = null;

					$val = new Validation();
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
					} else if ($registrationModel->selectByEmail($params->email) != false) {
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

					//入力任意の住所のバリデーションチェック
					if (!$val->checkEmpty($params->address)) {
						$_SESSION['address'] = $params->address;
						$addr = $_SESSION['address'];
					}

					//入力任意の仕事のバリデーションチェック
					if (!$val->checkEmpty($params->work)) {
						$_SESSION['work'] = $params->work;
						$work = $_SESSION['work'];
					}

					//入力任意の年のバリデーションチェック
					if (!$val->checkEmpty($params->year)) {
						$_SESSION['year'] = $params->year;
						$year = $_SESSION['year'];
					}

					//入力任意の月のバリデーションチェック
					if (!$val->checkEmpty($params->month)) {
						$_SESSION['month'] = $params->month;
						$month = $_SESSION['month'];
					}

					//入力任意の日のバリデーションチェック
					if (!$val->checkEmpty($params->day)) {
						$_SESSION['day'] = $params->day;
						$day = $_SESSION['day'];
					}

					//年月日全て入力されていた場合、つなぎ合わせる
					if ($year != "" && $month != "" && $day != "") {
						$birthday = "{$year}/{$month}/{$day}";
					}

					//バリデーションチェックをしてエラーがない場合
					if (count($errors) == 0) {
						$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
						$newUsersId = $registrationModel->insertUsers($email, $hashed_pass);
						$newUser_detailId = $registrationModel->insertUser_d($name, $addr, $birthday, $tel, $work, $newUsersId);
						return "complete";
					//バリデーションチェックをしてエラーがある場合
					} else {
						$_SESSION['errors'] = $errors;
						return "view/registration.php";
					}
				} catch (PDOException $e) {
					die ("データベースエラー:".$e->getMessage());
				} catch (Exception $e) {
					echo $e->getMessage(), "例外発生"; 
				}
				return "view/registration.php";
			} else {
				return "view/login.php";
			} 
		} catch (PDOException $e) {
			die ("データベースエラー:".$e->getMessage());
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}
	}
}