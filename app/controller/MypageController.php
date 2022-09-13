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
		var_dump($params);
		$mypageModel = createModel("MypageModel");
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
    return "view/mypage.php";

		
	}
}