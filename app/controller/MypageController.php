<?php
require_once("controller/Controller.php");
require_once('utilities/Form.php');
require_once('utilities/Validation.php');
require_once('common/Message.php');

class MypageController extends Controller {
	/**
	 * マイページへ遷移する
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
	public function action($params, $model) {
		try {
			$mypageModel = createModel("MypageModel");
			$val = new Validation();
			$message = null;
			$errors = [];
			//クイズ画面で「マイページ」ボタンが押された場合
			if ($params->action === "mypage" && isset($params->submit) === false) {
				$form    = new Form();
				$works   = $mypageModel->selectWorks();
				$address = $mypageModel->selectAddress();
				$years   = $form->makeItems(1950, 2020);
				$months  = $form->makeItems(1, 12);
				$days    = $form->makeItems(1, 31);
				$_SESSION['addresss'] = $address;
				$_SESSION['works']    = $works;
				$_SESSION['years']    = $years;
				$_SESSION['months']   = $months;
				$_SESSION['days']     = $days;
			//名前欄の更新ボタンが押された場合
			} else if ($params->item === "name") {
				if ($val->checkEmpty($params->name)) {
					$errors['name'] = Message::$NAME_EMPTY;
				} else {
					$updateRow = $mypageModel->updateName($params->name, $_SESSION['id']);
					$_SESSION['name'] = $params->name;
					$message = "名前を更新しました";
				}
			//メールアドレス欄の更新ボタンが押された場合
			} else if ($params->item === "email") {
				if ($val->checkEmpty($params->email)) {
					$errors['email'] = Message::$EMAIL_EMPTY;
				} else if ($val->checklPattern(0, $params->email)) {
					$errors['email'] = Message::$EMAIL_NOT_CORRECT;
				} else {
					$updateRow = $mypageModel->updateEmail($params->email, $_SESSION['id']);
					$_SESSION['email'] = $params->email;
					$message = "メールアドレスを更新しました";
				}
			//パスワード欄の更新ボタンが押された場合
			} else if ($params->item === "password") {
				if ($val->checkEmpty($params->password)) {
					$errors['password'] = Message::$PASS_EMPTY;
				} else if ($val->checkEmpty($params->password_confirm)) {
					$errors['password_confirm'] = Message::$PASS_CONFIRM_EMPTY;
				} else if ($val->checklPattern(1, $params->password)) {
					$errors['password'] = Message::$PASS_NOT_CORRECT;
				} else if ($params->password !== $params->password_confirm) {
					$errors['password_confirm'] = Message::$PASS_NOT_EQUAL;
				} else {
					$hashed_pass = password_hash($params->password, PASSWORD_DEFAULT);
					$updateRow = $mypageModel->updatePassword($hashed_pass, $_SESSION['id']);
					$message = "パスワードを更新しました";
				}
			//住所の更新ボタンが押された場合
			} else if ($params->item === 'address') {
				if ($val->checkEmpty($params->address)) {
					$errors['address'] = Message::$ADDRESS_NOT_SELECT;
				} else {
					$updateRow = $mypageModel->updateAddress($params->address, $_SESSION['id']);
					$_SESSION['address'] = $params->address;
					$message = "住所を更新しました";
				}
			//生年月日の更新ボタンが押された場合
			} else if ($params->item === 'birthday') {
				if ($val->checkEmpty($params->year) || $val->checkEmpty($params->month) || $val->checkEmpty($params->day)) {
					$errors['birthday'] = Message::$BIRTHDAY_NOT_SELECT;
				} else {
					$_SESSION['year'] = $params->year;
					$_SESSION['month'] = $params->month;
					$_SESSION['day'] = $params->day;
					$birthday = "{$params->year}/{$params->month}/{$params->day}";
					$updateRow = $mypageModel->updateBirthday($birthday, $_SESSION['id']);
					$_SESSION['birthday'] = $birthday;
					$message = "生年月日を更新しました";
				}
			//電話番号欄の更新ボタンが押された場合
			} else if ($params->item === "tel") {
				if ($val->checkEmpty($params->tel)) {
					$errors['tel'] = Message::$TEL_EMPTY;
				} else if ($val->checklPattern(2, $params->tel)) {
					$errors['tel'] =  Message::$TEL_NO_CORRECT;
				} else {
					$updateRow = $mypageModel->updateTel($params->tel, $_SESSION['id']);
					$_SESSION['tel'] = $params->tel;
					$message = "電話番号を更新しました";
				}
			//仕事欄の更新ボタンが押された場合
			} else if ($params->item === 'work') {
				if ($val->checkEmpty($params->work)) {
					$errors['work'] = Message::$WORL_NOT_SELECT;
				} else {
					$updateRow = $mypageModel->updateWork($params->work, $_SESSION['id']);
					$_SESSION['work'] = $params->work;
					$message = "仕事を更新しました";
				}
			}
			$_SESSION['errors'] = $errors;
			$_SESSION['message'] = $message;
			return "view/mypage.php";
		} catch (PDOException $e) {
			die ("データベースエラー:".$e->getMessage());
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}

		
	}
}