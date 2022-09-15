<?php
require_once("model/Model.php");

class MypageModel extends Model {
  	/**
	 * データベースを接続
	 */
	function __construct() {
    parent::__construct();
  }

	/**
	 * user＿detail表の名前を更新するメソッド
	 *
	 * @param string $name 入力された名前
	 * 								$id ログイン中のユーザーID
	 * @return integer 更新された行数
	 */
	public function updateName($name, $id) {
		$sql = "UPDATE user_detail
						SET name = ?
						WHERE id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $name);
		$stt->bindValue(2, $id);
		$stt->execute();
		return $stt->rowCount();
	}

	/**
	 * users表のメールアドレスを更新するメソッド
	 *
	 * @param string $email 入力されたメールアドレス
	 * 							 $password パスワード
	 * @return integer 更新された行数
	 */
	public function updateEmail($email, $id) {
		$sql = "UPDATE users
						SET email = ?
						WHERE id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $email);
		$stt->bindValue(2, $id);
		$stt->execute();
		return $stt->rowCount();
	}
}