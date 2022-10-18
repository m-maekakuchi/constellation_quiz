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
   *                $questions_id
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

	/**
	 * questions表から同じ問題文を取得するメソッド
	 *
	 * @param string $question 問題文
	 * 
	 *@return integer 行数
	 */
	public function selectSameQueNum($question) {
		$sql = "SELECT
    					COUNT(*) AS sameQueNum
						FROM
   						questions
						WHERE
    					content = ?";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $question);
		$stt->execute();
		return $stt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * answer_history表に新しい列を登録するメソッド
	 *
	 * @param string $question_id 
	 * 
	 *@return array 登録結果
	 */
	public function insertColum($question_id) {
		$prenum = $question_id - 1;
		$sql = "ALTER TABLE
    					answer_history 
						ADD COLUMN choices_id{$question_id} INT 
						AFTER choices_id{$prenum}";
		$stt = $this->prepare($sql);
		$stt->execute();
		return $stt->rowCount();
	}

	/**
	 * questions表からメソッド
	 *
	 * @param string $question_id 
	 * 
	 *@return array 検索結果
	 */
	public function selectQue($str) {
		$sql = "";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $str);
		$stt->execute();
		return $stt->fetch(PDO::FETCH_ASSOC);
	}
}