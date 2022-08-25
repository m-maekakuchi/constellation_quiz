<?php
require_once ("dao/Dao.php");

class RegistDao extends Dao {

	/**
	 * users表に登録するメソッド
	 *
	 * @param string $id　ユーザーID
	 * 				$email メールアドレス
	 * 				$password パスワード
	 * @return array 検索結果（二次元配列）
	 */
	public function insertUsers($id, $email, $password) {
		$this->open();
		$sql = "INSERT INTO users(id, email, password)
						VALUES(?, ?, ?);";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $id);
		$stt->bindValue(2, $email);
		$stt->bindValue(3, $password);
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * user_detail表に登録するメソッド
	 *
	 * @param string $id　ユーザーID
	 * 				$name 名前
	 * 				$address_id addresss表のID
	 * 				$birthday 誕生日
	 * 				$tel 電話番号
	 * 				$works_id works表のID
	 * 				$users_id users表のID
	 * @return array 検索結果（二次元配列）
	 */
	public function insertUser_d($id, $name, $address_id, $birthday, $tel, $works_id, $users_id) {
		$this->open();
		$sql = "INSERT INTO user_detail(
							id,
							name,
							address_id,
							birthday,
							tel,
							works_id,
							users_id
						)
						VALUES(?, ?, ?, ?, ?, ?, ?);";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $id);
		$stt->bindValue(2, $name);
		$stt->bindValue(3, $address_id);
		$stt->bindValue(4, $birthday);
		$stt->bindValue(5, $tel);
		$stt->bindValue(6, $works_id);
		$stt->bindValue(7, $users_id);
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_ASSOC);
	}

}