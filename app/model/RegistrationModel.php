<?php
require_once("model/Model.php");

class RegistrationModel extends Model {
  	/**
	 * データベースを接続
	 */
	function __construct() {
    parent::__construct();
  }

		/**
	 * users表に登録するメソッド
	 *
	 * @param string $email メールアドレス
	 * 							 $password パスワード
	 * @return integer 挿入された行ID
	 */
	public function insertUsers($email, $password) {
		$sql = "INSERT INTO users(email, password, status_id)
						VALUES(?, ?, 1);";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $email);
		$stt->bindValue(2, $password);
		$stt->execute();
		return $this->lastInsertId();
	}

	/**
	 * user_detail表に登録するメソッド
	 *
	 * @param string $name 名前
	 * 								$address_id addresss表のID
	 * 								$birthday 誕生日
	 * 								$tel 電話番号
	 * 								$works_id works表のID
	 * 								$users_id users表のID
	 * @return array integer 挿入された行ID
	 */
	public function insertUser_d($name, $address_id, $birthday, $tel, $works_id, $users_id) {
		$sql = "INSERT INTO user_detail(
							name,
							address_id,
							birthday,
							tel,
							works_id,
							users_id
						)
						VALUES(?, ?, ?, ?, ?, ?);";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $name);
		$stt->bindValue(2, $address_id);
		$stt->bindValue(3, $birthday);
		$stt->bindValue(4, $tel);
		$stt->bindValue(5, $works_id);
		$stt->bindValue(6, $users_id);
		$stt->execute();
		return $this->lastInsertId();
	}
}