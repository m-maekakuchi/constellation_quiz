<?php
abstract class Controller {
	/**
	 * リクエストを処理するメソッド
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
	public abstract function action($params, $model);

	/**
	 * Viewを表示するメソッド
	 *
	 * @param string $viewPath
	 *            Viewのパス(PHPファイルのパス)
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return void
	 */
	public function view($viewPath, $model) {
			// 引数$modelは、ViewのPHPファイル内で使用可能
			require_once ($viewPath);
	}
}