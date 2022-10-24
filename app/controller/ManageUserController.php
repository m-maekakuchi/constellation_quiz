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
				$message  = "";
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
						//該当者がいる場合
						if (count($users) != 0) {
							$_REQUEST['users'] = $users;
						//該当者がいなかった場合
						} else {
							$message = Message::$NOT_FIND_USERS;
						}
					}
				//管理者にするボタンが押された場合
				} else if (isset($params->addAdmin)) {
					$updateRow = $manageUserModel->updateStatus($params->userId);
					//管理者に変更できた場合
					if ($updateRow > 0) {
						$message = $params->userName.Message::$UPDATE_STATUS;
					//不正な値が入力された場合
					} else {
						$message = Message::$NOT_UPDATE_STATUS;
					}
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