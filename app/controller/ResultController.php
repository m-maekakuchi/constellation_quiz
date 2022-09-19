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
    try {
      if (isset($_SESSION['loginStatus'])) {
        $corr_num = 0;
        $answers = $_SESSION['answers'];
        $questions_num = $_SESSION['questions_num'];
        $resultModel = createModel("ResultModel");
        $corr_ans = $resultModel->selectFlugs();
        
        for ($i = 0; $i < $questions_num; $i++) {
          if ($answers[$i] == $corr_ans[$i]['id']) {
            $corr_num++;
          }
        }
        $_SESSION['corr_num'] = $corr_num;
        return "view/result.php";
      } else {
				return "view/login.php";
			}      
  //     //結果ページから戻ってきた場合
  //     } elseif (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $url) {
  //       for ($i = 1; $i <= $_SESSION['questions_num']; $i++) {
  //         $choices_id = "choices_id".$i;
  //         unset($_SESSION[$choices_id]);
  //       }
  //       return "view/question.php";
  //     }
    } catch (PDOException $e) {
      die ("データベースエラー:".$e->getMessage());
    } catch (Exception $e) {
      echo $e->getMessage(), "例外発生"; 
    }
  }
}