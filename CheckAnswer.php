<?php
  require_once('Data.php');
  session_start();

  class CheckAnswer {

    //クイズの結果と正答数を返す
    public function check_ans($userAnswers, $questions, $correctAnswers){
      $result = [];
      $countCorrAns = 0;
      for ($i = 0; $i < count($questions); $i++) {
        if ($correctAnswers[$i] == $questions[$i][1][$userAnswers[$i]]) {
          array_push($result, "正解です！");
          $countCorrAns++;
        } else {
          array_push($result, "不正解です！");
        }
      }
      return array($result, $countCorrAns);
    }
  }

?>