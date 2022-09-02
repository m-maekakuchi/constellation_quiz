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
		$user = Conf::USER;
		$password = Conf::PASSWORD;
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

	/**
	 * 挿入した最終行を取得するメソッド
	 *
	 * @return テーブルの最終行
	 */
	public function lastInsertId() {
		return $this->db->lastInsertId();
	}
}