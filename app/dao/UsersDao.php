<?php
require_once ("dao/Dao.php");

class UsersDao extends Dao {
	/**
	 * users表から同じメールアドレスのアカウントを取得
	 *
	 * @param string $id	ユーザーID
	 * 
	 * @return array 検索結果
	 */
	public function selectByEmail ($email) {
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

	/**
	 * users表に登録するメソッド
	 *
	 * @param string $id　ユーザーID
	 * 							$email メールアドレス
	 * 							$password パスワード
	 * @return array integer 最後に挿入された行ID
	 */
	public function insert($email, $password) {
		$this->open();
		$sql = "INSERT INTO users(email, password)
						VALUES(?, ?);";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $email);
		$stt->bindValue(2, $password);
		$stt->execute();
		return $this->lastInsertId();
	}

}