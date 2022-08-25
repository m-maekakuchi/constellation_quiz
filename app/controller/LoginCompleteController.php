<?php

require_once("controller/Controller.php");

class LoginCompleteController extends Controller {
  	/**
	 * クイズページへ遷移する
	 *
	 * @param array $params
	 *            リクエストパラメータ
	 * @param Model $model
	 *            Modelオブジェクト
	 * @return string Viewのパス
	 */
  public function action($params, $model) {
    require_once('utilities/Validation.php');
    require_once('common/Message.php');

    $error = "";

    try {
      if (empty($params->email) || empty($params->password)) {
        $error = Message::$EMAIL_OR_PASS_EMPTY;
        $_SESSION['error'] = $error;
				return "view/login.php";
      } else {
        $usersDao = createDao("UsersDao");
        $row = $usersDao->selectByEmail($params->email);
        //メールアドレスが一致するアカウントがある場合
        if ($row) {
          //ハッシュ化されたパスワードと入力されたパスワードが一致すればログイン成功
          if (password_verify($params->password, $row['password'])) {
            //会員情報をセッションにセットして問題に移動
            if ($row){
              $_SESSION['loginId'] = $row['id'];
              
              $userInfo = $usersDao->selectUserInfo($_SESSION['loginId']);
              $_SESSION['name'] = $userInfo['name'];
              $_SESSION['email'] = $params->email;
              $_SESSION['address'] = $userInfo['address'];
              $_SESSION['birthday'] = $userInfo['birthday'];
              $_SESSION['tel'] = $userInfo['tel'];
              $_SESSION['work'] = $userInfo['work'];

              $questionDao = createDao("QuestionDao");
              $questions_num = $questionDao->selectCount();
              $_SESSION['questions_num'] = $questions_num;

              $choicesDao = createDao("ChoicesDao");
              $correct_answers = $choicesDao->selectByFlg();
              $_SESSION['correct_answers'] = $correct_answers;

				      return "view/question.php";
            }
          } else {
            $error = Message::$PASSWORD_WRONG;
            $_SESSION['error'] = $error;
				    return "view/login.php";
          }
        } else {
          $error = Message::$EMAIL_NOT_REGIST;
          $_SESSION['error'] = $error;
				  return "view/login.php";
        }
      }
    } catch (PDOException $e) {
      die ("データベースエラー:".$e->getMessage());
    } catch (Exception $e) {
      echo $e->getMessage(), "例外発生"; 
    }
  }
}