<?php
require_once ("dao/Dao.php");

class LoginDao extends Dao {

	/**
	 * users表からメールアドレスをもとにアカウントを検索するメソッド
	 *
	 * @param string $email
	 *            メールアドレス
	 * @return array 検索結果（二次元配列）
	 */
	public function selectUserId($email) {
		$this->open();
		$sql = "SELECT
							id,
							password
						FROM
							users
						WHERE
							email = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $email);
		$stt->execute();
		return $stt->fetch(PDO::FETCH_ASSOC);

}

	/**
	 * users表からログインされたアカウントの情報を検索するメソッド
	 *
	 * @param string $userId
	 *            ユーザーID
	 * @return array 検索結果（二次元配列）
	 */
	public function selectUserInfo($userId) {
		$this->open();
		$sql = "SELECT
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