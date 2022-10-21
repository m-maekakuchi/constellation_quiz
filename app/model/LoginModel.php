<?php
require_once("common/Database.php");

class LoginModel extends Model {
	/**
	 * データベースを接続
	 */
	function __construct() {
			parent::__construct();
	}

	/**
	 * users表とuser_detail表からログインされたアカウントの情報を検索するメソッド
	 *
	 * @param string $userId　ユーザーID
	 * 
	 * @return array 検索結果
	 */
	public function selectUserInfo($userId) {
		$sql = "SELECT
					d.id AS id,
					d.name AS name,
					u.email AS email,
					u.password AS password,
					u.status_id AS status,
					d.address_id AS address,
					d.birthday AS birthday,
					d.tel AS tel,
					d.works_id AS work
				FROM
					users u
				LEFT JOIN user_detail d ON
					u.id = d.users_id
				WHERE
					users_id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $userId);
		$stt->execute();
		return $stt->fetch(PDO::FETCH_ASSOC);
	}
}