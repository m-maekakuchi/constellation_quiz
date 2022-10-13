<?php

header('Content-Type: application/json; charset=UTF-8');

$start = $_GET['start'];
$end = $_GET['end'];

if (isset($start) && isset($end)) {
  $arr['status'] = "yes";
  for ($i = $start; $i <= $end; $i++) {
    $arr['items'][] = $i;
  }
} else {
  $arr['status'] = "no";

}
// 配列をjson形式にデコードして出力, 第二引数は整形するためのオプション
print json_encode($arr, JSON_PRETTY_PRINT);