<?php
require_once ("dao/Dao.php");

class AdressDao extends Dao {
	/**
	 * addresss表から全件検索するメソッド
	 *
	 * @return array 検索結果（二次元配列）
	 */
	public function selectAll() {
		$this->open();
		$sql = "SELECT
							*
						FROM
							addresss;";
		$stt = $this->prepare($sql);
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_ASSOC);
	}
}