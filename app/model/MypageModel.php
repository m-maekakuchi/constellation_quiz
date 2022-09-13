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
	 * @param string $email メールアドレス
	 * 							 $password パスワード
	 * @return integer 挿入された行ID
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
}