<?php
require_once("controller/Controller.php");

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
		if ($params->action === "registration") {
			require_once('utilities/Form.php');

			try {
				$registrationModel = createModel("RegistrationModel");
				$form      = new Form();
				

				$address   = $registrationModel->selectAddress();
				$_SESSION['address'] = $address;
				$works     = $registrationModel->selectWorks();
				$_SESSION['works'] = $works;
				$years     = $form->makeItems(1950, 2020);
				$_SESSION['years'] = $years;
				$months    = $form->makeItems(1, 12);
				$_SESSION['months'] = $months;
				$days      = $form->makeItems(1, 31);
				$_SESSION['days'] = $days;

				if (isset($_SESSION['errors'])) {
					$errors = $_SESSION['errors'];
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
	}
}