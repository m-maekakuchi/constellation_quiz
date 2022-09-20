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
	 * 							 $id ログイン中のユーザーID
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
	 * 							 $id ログイン中のユーザーID
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

	/**
	 * users表のパスワードを更新するメソッド
	 *
	 * @param string $password 入力されたメールアドレス
	 * 							 $id ログイン中のユーザーID
	 * @return integer 更新された行数
	 */
	public function updatePassword($password, $id) {
		$sql = "UPDATE users
						SET password = ?
						WHERE id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $password);
		$stt->bindValue(2, $id);
		$stt->execute();
		return $stt->rowCount();
	}

	/**
	 * user＿detail表の住所を更新するメソッド
	 *
	 * @param string $address 入力された仕事
	 * 							 $id ログイン中のユーザーID
	 * @return integer 更新された行数
	 */
	public function updateAddress($address, $id) {
		$sql = "UPDATE user_detail
						SET address_id = ?
						WHERE id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $address);
		$stt->bindValue(2, $id);
		$stt->execute();
		return $stt->rowCount();
	}

	/**
	 * user＿detail表の誕生日を更新するメソッド
	 *
	 * @param string $birthday 入力された生年月日
	 * 							 $id ログイン中のユーザーID
	 * @return integer 更新された行数
	 */
	public function updateBirthday($birthday, $id) {
		$sql = "UPDATE user_detail
						SET birthday = ?
						WHERE id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $birthday);
		$stt->bindValue(2, $id);
		$stt->execute();
		return $stt->rowCount();
	}

	/**
	 * user＿detail表の電話番号を更新するメソッド
	 *
	 * @param string $tel 入力された電話番号
	 * 							 $id ログイン中のユーザーID
	 * @return integer 更新された行数
	 */
	public function updateTel($tel, $id) {
		$sql = "UPDATE user_detail
						SET tel = ?
						WHERE id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $tel);
		$stt->bindValue(2, $id);
		$stt->execute();
		return $stt->rowCount();
	}

	/**
	 * user＿detail表の仕事を更新するメソッド
	 *
	 * @param string $work 入力された仕事
	 * 							 $id ログイン中のユーザーID
	 * @return integer 更新された行数
	 */
	public function updateWork($work, $id) {
		$sql = "UPDATE user_detail
						SET works_id = ?
						WHERE id = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $work);
		$stt->bindValue(2, $id);
		$stt->execute();
		return $stt->rowCount();
	}

		/**
	 * クイズ結果のcsv出力
	 */
  public function csvDownload($id, $questions_num) {
    $csvstr   = "";
    for ($i = 1; $i <= $questions_num; $i++) {
      $csvstr .= "第{$i}問,";
      if ($i == $questions_num) {
        $csvstr .= "回答日\n";
      }
    }
    
    $sql = "SELECT
              choices_id1 AS '第1問', 
              choices_id2 AS '第2問',
              choices_id3 AS '第3問',
              choices_id4 AS '第4問',
              choices_id5 AS '第5問',
              choices_id6 AS '第6問',
              choices_id7 AS '第7問',
              choices_id8 AS '第8問',
              choices_id9 AS '第9問',
              choices_id10 AS '第10問',
              created_at AS '回答日'
            FROM
              answer_history
            WHERE
              users_id = ? AND '2022-09-19 00:00:00' <= created_at AND created_at < '2022-09-20 00:00:00';";
    $stt = $this->prepare($sql);
    $stt->bindValue(1, $id);
		$stt->execute();
		while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
      $csvstr .= $row['第1問'].",";
      $csvstr .= $row['第2問'].",";
      $csvstr .= $row['第3問'].",";
      $csvstr .= $row['第4問'].",";
      $csvstr .= $row['第5問'].",";
      $csvstr .= $row['第6問'].",";
      $csvstr .= $row['第7問'].",";
      $csvstr .= $row['第8問'].",";
      $csvstr .= $row['第9問'].",";
      $csvstr .= $row['第10問'].",";
      $csvstr .= $row['回答日']."\n";
    }

    return $csvstr;
  }
}