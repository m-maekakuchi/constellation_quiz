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

		/**
	 * クイズ結果をcsvで出力するメソッド
	 */
	public function csvDownload($fileName, $data) {
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename='.$fileName);
		echo mb_convert_encoding($data, "SJIS", "UTF-8");
	}

		/**
	 * クイズ結果をpdfで出力するための文字列を生成するメソッド
	 */
  public function makeHTML($id, $questions_num, $corr_ans) {
		//csvで出力する文字列
    $pdfStr = "<tr>";
		//列名を設定
    for ($i = 1; $i <= $questions_num; $i++) {
      $pdfStr .= "<th class='question'>第{$i}問</th>
									<th class='rightOrWrong'>正誤</th>";
      if ($i == $questions_num) {
        $pdfStr .= "<th class='corrRate'>正解率</th>
										<th class='date'>回答日</th>
										</tr>";
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
			$pdfStr .= "<tr>";
			for ($i = 1; $i <= $questions_num; $i++) {
				$pdfStr .= "<td class='question'>".$row["第{$i}問"]."</td>";
				//クイズの正誤を○×で登録
				if ($row["第{$i}問"] == $corr_ans[$i - 1]['id']) {
					$corr_num++;
					$pdfStr .= "<td class='rightOrWrong'>○</td>";
				} else {
					$pdfStr .= "<td class='rightOrWrong'>×</td>";
				}
			}
			$corr_rate = $corr_num / $questions_num * 100;
			$pdfStr .= "<td class='corrRate'>{$corr_rate}</td>";
      $pdfStr .= "<td class='date'>{$row['回答日']}</td></tr>";
    }
    return $pdfStr;
	}

	/**
	 * クイズ結果をpdfで出力するメソッド
	 */
	public function pdfDownload($data) {
		require_once("lib/TCPDF/tcpdf.php");
		$orientation = 'Landscape';			// 用紙の向き
		$unit        = 'mm';						// 単位
		$format      = 'A4';						// 用紙フォーマット
		$unicode     = true;						// ドキュメントテキストがUnicodeの場合にTRUEとする
		$encoding    = 'UTF-8';					// 文字コード
		$diskcache   = false;						// ディスクキャッシュを使うかどうか
		//TCPDFインスタンスを作成
		$tcpdf = new TCPDF($orientation, $unit, $format, $unicode, $encoding, $diskcache);
		$tcpdf->AddPage();
		$tcpdf->SetMargins(4, 4, 4);
		$tcpdf->SetTitle('quiz result');
		$tcpdf->SetFont("kozgopromedium", "", 5);
		$tcpdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

$html = <<< EOF
	<style>
		table, th, td {
			border: solid 0.5px #000000;
		}
		table th {
			text-align: center;
		}
		table td {
			text-align: center;
		}
	</style>
	<h1>クイズ結果</h1>
	<table width="800px">
		$data
	</table>
EOF;

		$tcpdf->writeHTML($html);
		$fileName = 'quizResult.pdf';
		$tcpdf->Output($fileName, "I");
	}
}