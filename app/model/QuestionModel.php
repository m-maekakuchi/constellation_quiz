<?php
require_once ("common/Database.php");

class QuestionModel extends Model {
	/**
	 * データベースを接続
	 */
	function __construct() {
		parent::__construct();
	}

	/**
	 * questions表のレコード数を取得
	 * 
	 * @return レコード数
	 */
	public function selectCount() {
		$sql = "SELECT
							COUNT(*) AS questions_num
						FROM
							questions";
		$stt = $this->prepare($sql);
		$stt->execute();
		return $stt->fetchColumn();
	}

	/**
	 * questions表とchoices表から問題文と選択肢を取得
	 */
	public function selectContents($id) {
		$sql = "SELECT
							q.id AS QUESTION_ID,
							q.content AS QUESTION,
							c.id AS CHOICE_ID,
							c.content AS OPTIONS
						FROM
							questions q
						JOIN choices c ON
							q.id = c.questions_id
						WHERE
							q.id = $id";
		$stt = $this->prepare($sql);
		$stt->execute();
		//連想配列の形でレコード群を1つの配列に格納
		$all = $stt->fetchAll(PDO::FETCH_ASSOC);

		$content = [];
		$contents = [];
		$loop = 0;
		for ($i = 0; $i < count($all); $i++) {
			$loop++;
			if ($i % 4 === 0) {
				$content['QUESTION_ID'] = $all[$i]['QUESTION_ID'];
				$content['QUESTION'] = $all[$i]['QUESTION'];
			}
			$content['CHOICE_ID'][] = $all[$i]['CHOICE_ID'];
			$content['OPTIONS'][] = $all[$i]['OPTIONS'];

			if ($loop == 4) {
				array_push($contents, $content);
				$content = [];
				$loop = 0;
			}
		}
		// return $contents;

		$choices = [];
		$choice_ids = [];
		$title = $contents[0]['QUESTION'];

		for ($i = 0; $i < count($contents[0]['OPTIONS']); $i++) {
			$choice = $contents[0]['OPTIONS'][$i];
			array_push($choices, $choice);
		}
		for ($i = 0; $i < count($contents[0]['CHOICE_ID']); $i++) {
			$choice_id = $contents[0]['CHOICE_ID'][$i];
			array_push($choice_ids, $choice_id);
		}

		$_SESSION['title'] = $title;
		$_SESSION['choices'] = $choices;
		$_SESSION['choice_ids'] = $choice_ids;
	}

	/**
	 * choices表から正答を取得
	 * 
	 * @return 二次元配列
	 */
  public function selectByFlg($id) {
    $sql = "SELECT
              id
            FROM
              choices
            WHERE
              result_flg = 1 AND questions_id = $id";
    $stt = $this->prepare($sql);
		$stt->execute();
    return $stt->fetch(PDO::FETCH_ASSOC);
  }
}