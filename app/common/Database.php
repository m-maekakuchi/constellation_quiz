<?php
require_once("common/Conf.php");

class Database {
  /**
	 * PDOオブジェクト
	 *
	 * @var PDO
	 */
	private $db;

	/**
	 * データベースへ接続するメソッド
	 *
	 * @return void
	 */
	function __construct() {
		$dsn = Conf::DSN;
		$user ='root';
		$password ="root";
		$this->db = new PDO($dsn, $user, $password);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	/**
	 * データベースとの通信を切断するメソッド
	 *
	 * @return void
	 */
	public function close() {
		$this->db = null;
	}

	/**
	 * PDOStatementオブジェクトを取得するメソッド
	 *
	 * @param string $sql
	 *            SQL文
	 * @return PDOStatement オブジェクト
	 */
	public function prepare($sql) {
		return $this->db->prepare($sql);
	}

	// /**
	//  * 最後に挿入された行IDを取得するメソッド
	//  *
	//  * @return string 最後に挿入された行ID
	//  */
	// public function lastInsertId() {
	// 	return $this->db->lastInsertId();
	// }
}