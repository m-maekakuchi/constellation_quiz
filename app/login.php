<?php
  require_once('QuizDao.php');
  require_once('Validation.php');
  require_once('common/Message.php');
  session_start();

  $userId  = 0;
  $failure = "";
  $url     = 'http://localhost/marie/quiz/app/question.php';
  $dao     = null;
  $error   = "";
  echo $myPath = __FILE__;              //  /home/php/basic/test.php
  echo $dirname = dirname($myPath);     // $dirname => '/home/php/basic'
  try {
    //ログインボタンが押された場合
    if (isset($_POST['submit'])) {
      if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = Message::$EMAIL_OR_PASS_EMPTY;
      } else {
        $dao = new QuizDao();
        $row = $dao->selectUserId($_POST['email']);
        //メールアドレスが一致するアカウントがある場合
        if ($row) {
          //ハッシュ化されたパスワードと入力されたパスワードが一致すればログイン成功
          if (password_verify($_POST['password'], $row['password'])) {
            //会員情報をセッションにセットして問題に移動
            if ($row){
              $_SESSION['loginId'] = $row['id'];
              $userInfo = $dao->selectUserInfo($_SESSION['loginId']);
              $_SESSION['name'] = $userInfo['name'];
              $_SESSION['email'] = $_POST['email'];
              $_SESSION['address'] = $userInfo['address'];
              $_SESSION['birthday'] = $userInfo['birthday'];
              $_SESSION['tel'] = $userInfo['tel'];
              $_SESSION['work'] = $userInfo['work'];
              header('Location: '.$url);
              exit();
            }
          } else {
            $error = Message::$PASSWORD_WRONG;
          }
        } else {
          $error = Message::$EMAIL_NOT_REGIST;
        }
      }
    }
  } catch (PDOException $e) {
    die ("データベースエラー:".$e->getMessage());
  } catch (Exception $e) {
    echo $e->getMessage(), "例外発生"; 
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=”viewport” content=”width=device-width, initial-scale=1”>
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="login">
  <main>
    <div class="container">
      <div class="top-wrapper">
        <h2>星座クイズ</h2>
        <p>星座にまつわるクイズに挑戦しませんか</p>
        <a href="registration.php" class="btn top">アカウント登録はこちら</a>
      </div>
      <div class="form-wrapper">
      <?php if(isset($error)) echo "<p class='error'>{$error}</p>"; ?>
        <form action="login.php" method="post">
          <div class="login-form">
            <input type="email" name="email" placeholder="メールアドレス" /><br>
            
          </div>
          <div class="login-form">
            <input type="password" name="password" placeholder="パスワード" />
          </div>
          <input type="submit" name="submit" class="btn submit" value="ログイン" />
        </form>
      </div>
    </div>
  </main>
</body>
</html>