<?php

require_once("controller/Controller.php");
require_once('common/Message.php');

class ResultController extends Controller {
  /**
	 * クイズ結果ページへ遷移する
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
	public function action($params, $model) {
    $answers = [];
		if (isset($_SESSION['answers'])) {
			$answers = $_SESSION['answers'];
		}
		array_push($answers, $params->choices_id);
		$_SESSION['answers'] = $answers;

  //   $val_count = 0;
  //   $success   = 0;
  //   $url       = 'http://localhost/marie/quiz/app/view/result.php';
    
  //   try {
  //     //回答ボタンが押された場合
  //     if (isset($_POST['submit']) && $_POST['submit'] == "回答する") {
  //       //選択されていない問題があるかの判定
  //       for ($i = 1; $i <= $_SESSION['questions_num']; $i++) {
  //         $choices_id = "choices_id".$i;
  //         if (!isset($_POST[$choices_id])) {
  //           $val_count++;
  //         } else {
  //           $_SESSION[$choices_id] = $_POST[$choices_id];
  //         }
  //       }

          return "view/result.php";
  //     //結果ページから戻ってきた場合
  //     } elseif (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $url) {
  //       for ($i = 1; $i <= $_SESSION['questions_num']; $i++) {
  //         $choices_id = "choices_id".$i;
  //         unset($_SESSION[$choices_id]);
  //       }
  //       return "view/question.php";
  //     }
  //   } catch (PDOException $e) {
  //     die ("データベースエラー:".$e->getMessage());
  //   } catch (Exception $e) {
  //     echo $e->getMessage(), "例外発生"; 
  //   }
  }
}