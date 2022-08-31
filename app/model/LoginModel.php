<?php
require_once("common/Database.php");

class LoginModel extends Database {
	/**
	 * データベースを接続
	 */
	function __construct() {
			parent::__construct();
	}

	/**
	 * users表から同じメールアドレスのアカウントを取得
	 *
	 * @param string $id	ユーザーID
	 * 
	 * @return array 検索結果
	 */
	public function selectByEmail ($email) {
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
	 * users表からログインされたアカウントの情報を検索してセッションに登録するメソッド
	 *
	 * @param string $userId　ユーザーID
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
		$user = $stt->fetch(PDO::FETCH_ASSOC);

		$_SESSION['loginId'] = $user['id'];
		$_SESSION['name'] = $user['name'];
		$_SESSION['email'] = $user['email'];
		$_SESSION['address'] = $user['address'];
		$_SESSION['birthday'] = $user['birthday'];
		$_SESSION['tel'] = $user['tel'];
		$_SESSION['work'] = $user['work'];
	}

	// /**
	//  * users表に登録するメソッド
	//  *
	//  * @param string $id　ユーザーID
	//  * 							$email メールアドレス
	//  * 							$password パスワード
	//  * @return array integer 最後に挿入された行ID
	//  */
	// public function insert($email, $password) {
	// 	$sql = "INSERT INTO users(email, password)
	// 					VALUES(?, ?);";
	// 	$stt = $this->prepare($sql);
	// 	$stt->bindValue(1, $email);
	// 	$stt->bindValue(2, $password);
	// 	$stt->execute();
	// 	return $this->lastInsertId();
	// }

}