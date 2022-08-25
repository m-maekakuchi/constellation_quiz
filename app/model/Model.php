<?php

class Model
{

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