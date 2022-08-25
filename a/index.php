<?php
// // 自作関数ファイルの読み込み
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

$controllers = [
	'login'          => 'LoginController',
	// 'loginComplete'  => 'LoginCompleteController',
	// 'regist'         => 'RegistController',
	// 'registComplete' => 'RegistCompleteController',
	'question'       => 'QuestionController'
	// 'result'         => 'ResultController'
];
if (isset($params->action) === false) {
	$params->action = "login";
// } else if (array_key_exists($params->action, $controllers) === false) {
// 	$params->action = "error";
// 	$model->message = "不正なアクセスです";
} 
// else if (
// 					$params->action === "login"
// 					&& isset($_SESSION['loginStatus'])
// 					) {
// 	echo 'ログインボタンが押された<br>';
//   $params->action = "question";
// }

$controller = createController($controllers[$params->action]);
try {
	$view = $controller->action($params, $model);
	if (array_key_exists($view, $controllers) === true) {
		$params->action = $view;
		$controller = createController($controllers[$params->action]);
		$view = $controller->action($params, $model);
	}
} catch (Exception $e) {
	$model->message = $e->getMessage();
	$view = "app/view/error.php";
}
$controller->view($view, $model);