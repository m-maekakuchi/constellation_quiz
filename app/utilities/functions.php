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
 * Modelオブジェクトを生成する関数
 *
 * @param string $className
 *            Modelクラス名
 * @return Model オブジェクト
 */
function createModel($className) {
	$classPath = "model/" . $className . ".php";
	require_once ($classPath);
	// クラスからオブジェクト生成して返す
	return new $className();
}