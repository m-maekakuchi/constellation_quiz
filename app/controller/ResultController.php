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
      //ログイン状態が保たれていた場合
      if (isset($_SESSION['loginStatus'])) {
        $corr_num = 0;
        $answers = $_SESSION['answers'];
        $questions_num = $_SESSION['questions_num'];
        $resultModel = createModel("ResultModel");

        //ユーザーの回答の正誤を判断し、正解数を取得
        $corr_ans = $resultModel->selectFlugs();
        for ($i = 0; $i < $questions_num; $i++) {
          if ($answers[$i] == $corr_ans[$i]['id']) {
            $corr_num++;
          }
        }
        $_SESSION['corr_num'] = $corr_num;

        //ユーザーの回答をDBに登録
        $resultModel->insertAnswers($_SESSION['id'], $answers);

        return "view/result.php";
      } else {
				return "login";
			}
    } catch (PDOException $e) {
      die ("データベースエラー:".$e->getMessage());
    } catch (Exception $e) {
      echo $e->getMessage(), "例外発生"; 
    }
  }
}