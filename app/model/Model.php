<?php
require_once("common/Database.php");

class Model extends Database {
	/**
	 * データベースを接続
	 */
	function __construct() {
    parent::__construct();
  }

	/**
	 * users表から同じメールアドレスのアカウントを取得
	 *
	 * @param string $id	ユーザーID
	 * 
	 * @return array 検索結果
	 */
	public function selectByEmail ($email) {
		$sql = "SELECT
							id,
							password
						FROM
							users
						WHERE
							email = ?;";
		$stt = $this->prepare($sql);
		$stt->bindValue(1, $email);
		$stt->execute();
		return $stt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * addresss表から全件検索するメソッド
	 *
	 * @return array 検索結果（二次元配列）
	 */
	public function selectAddress() {
		$sql = "SELECT
							*
						FROM
							addresss;";
		$stt = $this->prepare($sql);
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_ASSOC);
	}

  /**
	 * works表から全件検索するメソッド
	 *
	 * @return array 検索結果（二次元配列）
	 */
	public function selectWorks() {
		$sql = "SELECT
							*
						FROM
							works;";
		$stt = $this->prepare($sql);
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_ASSOC);
	}

  	/**
	 * choices表から正答を取得するメソッド
	 *
	 * @return integer 配列
	 */
  public function selectFlugs() {
    $sql = "SELECT
              id
            FROM
              choices
            WHERE
              result_flg = 1;";
    $stt = $this->prepare($sql);
		$stt->execute();
		return $stt->fetchAll(PDO::FETCH_ASSOC);
  }





	/**
	 * クラスのプロパティ
	 *
	 * @var array
	 */
	private $data = array();

	/**
	 * __set()オーバーロードメソッド
	 *
	 * @param string $name
	 *            プロパティ名
	 * @param mixed $value
	 *            プロパティへ代入する値
	 * @return void
	 */
	public function __set($name, $value)
	{
			$this->data[$name] = $value;
	}

	/**
	 * __get()オーバーロードメソッド
	 *
	 * @param string $name
	 *            プロパティ名
	 * @return mixed プロパティ$data（配列）の値
	 */
	public function __get($name)
	{
			if (array_key_exists($name, $this->data)) {
					return $this->data[$name];
			} else {
					return null;
			}
	}

	/**
	 * __isset()オーバーロードメソッド
	 *
	 * @param string $name
	 *            プロパティ名
	 * @return void
	 */
	public function __isset($name)
	{
			return isset($this->data[$name]);
	}

	/**
	 * __unset()オーバーロードメソッド
	 *
	 * @param string $name
	 *            プロパティ名
	 * @return void
	 */
	public function __unset($name)
	{
			unset($this->data[$name]);
	}

	/**
	 * クラスのプロパティに連想配列をセットする
	 *
	 * @param array $properties
	 *            クラスのプロパティに設定する連想配列
	 * @return void
	 */
	public function setProperties($properties)
	{
			if (is_array($properties)) {
					$this->data = $properties;
			} else {
					throw new Exception("Invalid argument is not an array");
			}
	}

	/**
	 * クラスの全てのプロパティを連想配列で取得する
	 *
	 * @return array クラスのプロパティの連想配列
	 */
	public function getProperties()
	{
			return $this->data;
	}
	
}