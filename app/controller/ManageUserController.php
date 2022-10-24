<?php
require_once("controller/Controller.php");
require_once('utilities/Validation.php');
require_once('common/Message.php');

class ManageUserController extends Controller {
   /**
	 * 管理ページへ遷移する
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
				$message = "";
				$manageUserModel = createModel("ManageUserModel");

				//検索ボタンが押された場合
				if (isset($params->searchUser)) {
					$val = new Validation();
					//名前入力欄のバリデーションチェック
					if ($val->checkEmpty($params->name)) {
						$message = Message::$VAL_NAME_EMPTY;
					} else {
						$_REQUEST['name'] = $params->name;
						$users = $manageUserModel->selectUserInfo($params->name);
						if (count($users) != 0) {
							$_REQUEST['users'] = $users;
						} else {
							$message = '該当者はいませんでした';
						}
					}
				} else if (isset($params->addAdmin)) {
					// $updateRow = $manageUserModel->updateStatus($params->userId);
					$message = "〇〇さんを管理者として登録しました";
				}
				if ($message != "") {
					$_REQUEST['message'] = $message;
				}
        return "view/manageUser.php";
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