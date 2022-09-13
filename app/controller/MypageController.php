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
					echo 38;
					$errors['name'] = Message::$NAME_EMPTY;
					$_SESSION['errors'] = $errors;
				} else {
					$updateRow = $mypageModel->updateName($params->name, $_SESSION['id']);
					$_SESSION['name'] = $params->name;
					// $_SESSION['message'] = "名前を更新しました";
				}
			}
			return "view/mypage.php";
		} catch (PDOException $e) {
			die ("データベースエラー:".$e->getMessage());
		} catch (Exception $e) {
			echo $e->getMessage(), "例外発生"; 
		}

		
	}
}