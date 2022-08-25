<?php
require_once("dao/Dao.php");

class ChoicesDao extends Dao {
  /**
	 * choices表から正答を取得
	 * 
	 * @return 二次元配列
	 */
  public function selectByFlg() {
    $this->open();
    $sql = "SELECT
              id,
              questions_id
            FROM
              choices
            WHERE
              result_flg = 1";
    $stt = $this->prepare($sql);
		$stt->execute();
    return $stt->fetchAll(PDO::FETCH_ASSOC);
  }
}