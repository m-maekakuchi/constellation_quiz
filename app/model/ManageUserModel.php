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
	 * @return array 検索結果
	 */
	public function selectUserInfo($str) {
		$sql = "SELECT
              d.id AS id,
              d.name AS name,
              u.email AS email,
							u.status_id AS status
            FROM
              users u
            LEFT JOIN user_detail d ON
              u.id = d.users_id
            WHERE
              name LIKE '%{$str}%'";
		$stt = $this->prepare($sql);
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * users表のstatus_id列の値を変更するメソッド
	 *
	 * @param int $user_id
	 * 
	 * @return integer 更新された行数
	 */
	public function updateStatus($user_id) {
		$adminStatus = 2;
		$sql = "UPDATE
							users
						SET
							status_id = {$adminStatus}
						WHERE
							id = {$user_id}";
		$stt = $this->prepare($sql);
		var_dump($stt);
		$stt->execute();
		return $stt->rowCount();
	}
}