<?php
require_once("model/Model.php");

class ResultModel extends Model {
  	/**
	 * データベースを接続
	 */
	function __construct() {
    parent::__construct();
  }

  	/**
	 * choices表から正答を取得するメソッド
	 *
	 * @return integer 配列
	 */
  public function selectFlugs() {
    $sql = "SELECT
              id
            FROM
              choices
            WHERE
              result_flg = 1;";
    $stt = $this->prepare($sql);
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_ASSOC);
  }
}