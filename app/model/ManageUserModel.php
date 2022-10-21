<?php
require_once("common/Database.php");

class ManageUserModel extends Model {
	/**
	 * データベースを接続
	 */
	function __construct() {
			parent::__construct();
	}

  /**
	 * users表とuser_detail表からアカウントの情報を検索するメソッド
	 *
	 * @param string $str
	 * 
	 *@return array 検索結果
	 */
	public function selectUserInfo($str) {
		$sql = "SELECT
              d.id AS id,
              d.name AS name,
              u.email AS email
            FROM
              users u
            LEFT JOIN user_detail d ON
              u.id = d.users_id
            WHERE
              name LIKE '%{$str}%'";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $userId);
		$stt->execute();
		return $stt->fetch(PDO::FETCH_ASSOC);
	}
}