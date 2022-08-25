<?php
require_once ("dao/Dao.php");

class User_detailDao extends Dao {
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
	 * @return array integer 最後に挿入された行ID
	 */
	public function insert($name, $address_id, $birthday, $tel, $works_id, $users_id) {
		$this->open();
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