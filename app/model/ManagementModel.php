<?php
require_once("common/Database.php");

class ManagementModel extends Model {
	/**
	 * データベースを接続
	 */
	function __construct() {
			parent::__construct();
	}

	/**
	 * questions表に問題文を登録するメソッド
	 *
	 * @param string $question 問題文
	 * 
	 * @return integer 挿入された行ID
	 */
	public function insertQuestions($question) {
		$sql = "INSERT INTO questions(content) 
            VALUES (?)";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $question);
		$stt->execute();
		return $this->lastInsertId();
	}

  /**
	 * choices表に選択肢を登録するメソッド
	 *
	 * @param string $choices1 選択肢
   *                $result_flg 正答 or 誤答
   *                $corrAns 正答
	 *@return integer 挿入された行ID
	 */
	public function insertChoices($choice, $result_flg, $questions_id) {
		$sql = "INSERT INTO choices(content, result_flg, questions_id) 
            VALUES (?, ?, ?)";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $choice);
    $stt->bindValue(2, $result_flg);
    $stt->bindValue(3, $questions_id);
		$stt->execute();
		return $this->lastInsertId();
	}
}