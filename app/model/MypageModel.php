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
	 * クイズ結果をcsvで出力するための文字列を生成するメソッド
	 */
  public function csvOutput($id, $questions_num, $corr_ans) {
		//csvで出力する文字列
    $csvstr = "";
		//列名を設定
    for ($i = 1; $i <= $questions_num; $i++) {
      $csvstr .= "第{$i}問, 正誤, ";
      if ($i == $questions_num) {
        $csvstr .= "正解率, 回答日\n";
      }
    }
		//SQL文を生成
		$colums = "";
		for ($i = 1; $i <= $questions_num; $i++) {
			$colums .= "choices_id{$i} AS '第{$i}問',";
			if ($i == $questions_num) {
				$colums .= "created_at AS '回答日'";
			}
		}
    $sql = "SELECT
							{$colums}
            FROM
              answer_history
            WHERE
              users_id = ? AND '2022-08-01 00:00:00' <= created_at AND created_at < '2022-09-21 00:00:00';";
    $stt = $this->prepare($sql);
    $stt->bindValue(1, $id);
		$stt->execute();
		
		//answer_histrory表のデータとクイズの結果を一つの文字列にする
		while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
			$corr_num = 0;
			for ($i = 1; $i <= $questions_num; $i++) {
				$csvstr .= $row["第{$i}問"].",";
				//クイズの正誤を○×で登録
				if ($row["第{$i}問"] == $corr_ans[$i - 1]['id']) {
					$corr_num++;
					$csvstr .= "○, ";
				} else {
					$csvstr .= "×, ";
				}
			}
			$corr_rate = $corr_num / $questions_num * 100;
			$csvstr .= "{$corr_rate},";
      $csvstr .= $row['回答日']."\n";
    }
    return $csvstr;
	}

	public function csvDownload($fileName, $data) {
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename='.$fileName);
		echo mb_convert_encoding($data, "SJIS", "UTF-8");
	}
}