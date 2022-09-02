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
	 * users表からログインされたアカウントの情報を検索してセッションに登録するメソッド
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
					a.address AS address,
					d.birthday AS birthday,
					d.tel AS tel,
					w.work AS work
				FROM
					users u
				LEFT JOIN user_detail d ON
					u.id = d.users_id
				LEFT JOIN addresss a ON
					d.address_id = a.id
				LEFT JOIN works w ON
					d.works_id = w.id
				WHERE
					users_id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $userId);
		$stt->execute();
		return $stt->fetch(PDO::FETCH_ASSOC);		
	}
}