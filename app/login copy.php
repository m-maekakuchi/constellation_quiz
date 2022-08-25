<?php
  require_once('QuizDao.php');
  require_once('Validation.php');
  session_start();

  $userId  = 0;
  $failure = "";
  $url     = 'http://localhost/marie/quiz/app/question.php';
  $dao     = null;

  try {
    //ログインボタンが押された場合
    if (isset($_POST['submit'])) {
      if (empty($_POST['email']) || empty($_POST['password'])) {
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
            //パスワードが一致しない
          }
        } else {
          //一致するメールアドレスなし
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
<body>
  <header>
    <h2>星座クイズに挑戦</h2>
  </header>
  <main>
    <form action="login copy.php" method="post">
      <div class="item">
        <label for="email">メールアドレス：</label>
        <input type="email" id="email" name="email" placeholder="example@gmail.com" />
      </div>
      <div class="item">
        <label for="pass">パスワード：</label>
        <input type="password" id="pass" name="password" />
      </div>
      <div class = "btn">
        <input type="submit" name="submit" class="submit" value="ログイン">
        <a href="registration.php">アカウント作成</a>
      </div>
    </form>
  </main>
</body>
</html>