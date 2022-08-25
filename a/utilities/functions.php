<?php
/**
 * コントローラーオブジェクトを生成する関数
 *
 * @param string $className
 *            コントローラークラス名
 * @return Controller オブジェクト
 */
function createController($className) {
	// 指定されたクラス（ファイル）を読み込み
	$classPath = "controller/" . $className . ".php";
	require_once ($classPath);
	// クラスからオブジェクト生成して返す
	return new $className();
}

/**
 * DAOオブジェクトを生成する関数
 *
 * @param string $className
 *            DAOクラス名
 * @return DAO オブジェクト
 */
function createDao($className) {
	$classPath = "dao/" . $className . ".php";
	require_once ($classPath);
	// クラスからオブジェクト生成して返す
	return new $className();
}