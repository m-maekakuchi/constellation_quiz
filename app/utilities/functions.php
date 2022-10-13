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


/**
 * 現在のURLを取得
 *
 * @return String $url
 */
function nowUrl(){
	$url = '';
	if(isset($_SERVER['HTTPS'])){
			$url .= 'https://';
	}else{
			$url .= 'http://';
	}
	$url .= $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	return $url;
}

/**
 * WEBAPIを呼び出す
 *
 * @param string $className
 *            Modelクラス名
 * @return Model オブジェクト
 */
function callApi($start, $end) {
	// WebAPIのURL
	$url = nowUrl();
	$num = strrpos(nowUrl(), "/");
	$url = substr_replace(nowUrl(), "", $num+1)
		."utilities/api.php"
		."?start=${start}&end=${end}";
	// URLの内容を取得し、json形式からstdClass形式に変換し取得
	$data = json_decode(file_get_contents($url));
	// dataのstatusがyesだったら(出力に成功したら)
	if($data->status == "yes") {
		$arr = $data->items;
	}
	return $arr;
}