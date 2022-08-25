<?php
// 自作関数ファイルの読み込み
require_once ("utilities/functions.php");

session_start();

// Modelオブジェクトの生成（Viewで出力するデータをまとめるオブジェクト）
require_once ("model/Model.php");
$model = new Model();

// HTTPのGETメソッドとPOSTメソッドの判定し、リクエストパラメータを変数$paramsに代入
$params = new Model();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
	$params->setProperties($_GET);
} else {
	$params->setProperties($_POST);
}

// コントローラークラスをまとめた連想配列
$controllers = [
	'login'          => 'LoginController',
	'loginComplete'  => 'LoginCompleteController',
	'regist'         => 'RegistController',
	'registComplete' => 'RegistCompleteController',
	'question'       => 'QuestionController',
	'result'         => 'ResultController'
];

if (isset($params->action) === false) {
	// リクエストパラメータのactionの値が指定されていない場合
	// ログインページへ遷移するコントローラーを指定
	$params->action = "login";
} else if (array_key_exists($params->action, $controllers) === false) {
	$params->action = "error";
	$model->message = "不正なアクセスです";
}
$_SESSION['action'] = $params->action;
// リクエストパラメータのactionの値から生成済みのコントローラーを取得
$controller = createController($controllers[$params->action]);
try {
	// リクエストに対応した処理を行うメソッドの呼び出し、Viewのパスを取得
	$view = $controller->action($params, $model);
} catch (Exception $e) {
	// // エラー発生した場合の処理
	// $model->message = $e->getMessage();
	// $view = "app/view/error.php";
}
// Viewを表示
$controller->view($view, $model);