<?php
require_once ("dao/Dao.php");

class QuestionDao extends Dao {
	/**
	 * questions表のレコード数を取得
	 * 
	 * @return レコード数
	 */
	public function selectCount() {
		$this->open();
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
	 * 
	 * @return array 問題文と選択肢（二次元配列）
	 */
	public function selectContents($id) {
		$this->open();
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

		$contents = [];
		$content = [];
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
		return $contents;
	}
}