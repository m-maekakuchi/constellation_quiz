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
	 * answer_history表に回答を登録
	 *
	 * @return integer 更新された行数
	 */
  public function insertAnswers($id, $answers) {
    $len = count($answers);
    $colums = "users_id";
    $values = "?";
    for ($i = 1; $i <= $len; $i++) {
      $colums .= ", choices_id{$i}";
      $values .= ", ?";
    }
    $sql = "INSERT INTO answer_history({$colums})VALUES({$values});";
    $stt = $this->prepare($sql);
    $stt->bindValue(1, $id);
    for ($i = 0; $i < $len; $i++) {
      $stt->bindValue($i+2, $answers[$i]);
    }
		$stt->execute();
		return $stt->rowCount();
  }


}