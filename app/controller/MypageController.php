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
			//ログイン状態が保たれていた場合
			if (isset($_SESSION['loginStatus'])) {
				var_dump($params);
				$mypageModel = createModel("MypageModel");
				$val = new Validation();
				$message = null;
				$errors = [];
				//クイズ画面で「マイページ」ボタンが押された場合
				if ($params->action === "mypage" && isset($params->item) === false) {
					$form    = new Form();
					$works   = $mypageModel->selectWorks();
					$address = $mypageModel->selectAddress();
					$years   = $form->makeItems(1950, date('Y'));
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
						$errors['name'] = Message::$VAL_NAME_EMPTY;
					} else {
						$updateRow = $mypageModel->updateName($params->name, $_SESSION['id']);
						$_SESSION['name'] = $params->name;
						$message = Message::$UPDATE_NAME;
					}
				//メールアドレス欄の更新ボタンが押された場合
				} else if ($params->item === "email") {
					if ($val->checkEmpty($params->email)) {
						$errors['email'] = Message::$VAL_EMAIL_EMPTY;
					} else if ($val->checklPattern(0, $params->email)) {
						$errors['email'] = Message::$VAL_EMAIL_NOT_CORRECT;
					} else {
						$updateRow = $mypageModel->updateEmail($params->email, $_SESSION['id']);
						$_SESSION['email'] = $params->email;
						$message = Message::$UPDATE_EMAIL;
					}
				//パスワード欄の更新ボタンが押された場合
				} else if ($params->item === "password") {
					if ($val->checkEmpty($params->password)) {
						$errors['password'] = Message::$VAL_PASS_EMPTY;
					} else if ($val->checkEmpty($params->password_confirm)) {
						$errors['password_confirm'] = Message::$VAL_PASS_CONFIRM_EMPTY;
					} else if ($val->checklPattern(1, $params->password)) {
						$errors['password'] = Message::$VAL_PASS_NOT_CORRECT;
					} else if ($params->password !== $params->password_confirm) {
						$errors['password_confirm'] = Message::$VAL_PASS_NOT_EQUAL;
					} else {
						$hashed_pass = password_hash($params->password, PASSWORD_DEFAULT);
						$updateRow = $mypageModel->updatePassword($hashed_pass, $_SESSION['id']);
						$message = Message::$UPDATE_PASS;
					}
				//住所の更新ボタンが押された場合
				} else if ($params->item === 'address') {
					if ($val->checkEmpty($params->address)) {
						$errors['address'] = Message::$VAL_ADDRESS_NOT_SELECT;
					} else {
						$updateRow = $mypageModel->updateAddress($params->address, $_SESSION['id']);
						$_SESSION['address'] = $params->address;
						$message = Message::$UPDATE_ADDRESS;
					}
				//生年月日の更新ボタンが押された場合
				} else if ($params->item === 'birthday') {
					if ($val->checkEmpty($params->year) || $val->checkEmpty($params->month) || $val->checkEmpty($params->day)) {
						$errors['birthday'] = Message::$VAL_BIRTHDAY_NOT_SELECT;
					} else {
						$_SESSION['year'] = $params->year;
						$_SESSION['month'] = $params->month;
						$_SESSION['day'] = $params->day;
						$birthday = "{$params->year}/{$params->month}/{$params->day}";
						$updateRow = $mypageModel->updateBirthday($birthday, $_SESSION['id']);
						$_SESSION['birthday'] = $birthday;
						$message = Message::$UPDATE_BIRTHDAY;
					}
				//電話番号欄の更新ボタンが押された場合
				} else if ($params->item === "tel") {
					if ($val->checkEmpty($params->tel)) {
						$errors['tel'] = Message::$VAL_TEL_EMPTY;
					} else if ($val->checklPattern(2, $params->tel)) {
						$errors['tel'] =  Message::$VAL_TEL_NO_CORRECT;
					} else {
						$updateRow = $mypageModel->updateTel($params->tel, $_SESSION['id']);
						$_SESSION['tel'] = $params->tel;
						$message = Message::$UPDATE_TEL;
					}
				//仕事欄の更新ボタンが押された場合
				} else if ($params->item === 'work') {
					if ($val->checkEmpty($params->work)) {
						$errors['work'] = Message::$VAL_WORK_NOT_SELECT;
					} else {
						$updateRow = $mypageModel->updateWork($params->work, $_SESSION['id']);
						$_SESSION['work'] = $params->work;
						$message = Message::$UPDATE_WORK;
					}
				} else if ($params->submit === "csvダウンロード" || $params->submit === "pdfダウンロード") {
					if (
						empty($params->fromyear) ||
						empty($params->frommonth) ||
						empty($params->fromday) ||
						empty($params->toyear) ||
						empty($params->tomonth) ||
						empty($params->today)
					) {
						$_SESSION['fromyear'] = $params->fromyear;
						$_SESSION['frommonth'] = $params->frommonth;
						$_SESSION['fromday'] = $params->fromday;
						$_SESSION['toyear'] = $params->toyear;
						$_SESSION['tomonth'] = $params->tomonth;
						$_SESSION['today'] = $params->today;
						$errors['date'] = Message::$VAL_DATE_EMPTY;
					//「csvダウンロード」ボタンが押された場合
					} else if ($params->submit === "csvダウンロード") {
						$fromdate = "{$params->fromyear}/{$params->frommonth}/{$params->fromday}";
						$todate = "{$params->toyear}/{$params->tomonth}/{$params->today}";
						$corr_ans = $mypageModel->selectFlugs();
						$csvstr = $mypageModel->makeCsvStr($_SESSION['id'], $_SESSION['questions_num'], $corr_ans, $fromdate, $todate);
						$fileName = "quizResult.csv";
						$mypageModel->csvDownload($fileName, $csvstr);
						exit();
					//「pdfダウンロード」ボタンが押された場合
					} else {
						$fromdate = "{$params->fromyear}/{$params->frommonth}/{$params->fromday}";
						$todate = "{$params->toyear}/{$params->tomonth}/{$params->today}";
						$corr_ans = $mypageModel->selectFlugs();
						$html = $mypageModel->makeHTML($_SESSION['id'], $_SESSION['questions_num'], $corr_ans, $fromdate, $todate);
						$mypageModel->pdfDownload($html);
					}
				}
				$_SESSION['errors'] = $errors;
				$_SESSION['message'] = $message;
				return "view/mypage.php";
			} else {
				return "login";
			}
		} catch (PDOException $e) {
			die ("データベースエラー:".$e->getMessage());
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}
	}
}