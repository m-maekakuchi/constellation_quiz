<?php
  if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=”viewport” content=”width=device-width, initial-scale=1”>
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="view/css/style.css">
</head>
<body class="login">
  <main>
    <div class="container">
      <div class="top-wrapper">
        <h2>星座クイズ</h2>
        <p>星座にまつわるクイズに挑戦しませんか</p>
        <a href="index.php?action=registration" class="btn top">アカウント登録はこちら</a>
      </div>
      <div class="form-wrapper">
        <?php if(isset($error)) echo "<p class='error'>{$error}</p>"; ?>
        <form action="index.php" method="post" name="loginForm">
          <div class="login-form">
            <input type="text" id="email" name="email" placeholder="メールアドレス" />
          </div>
          <div class="login-form">
            <input type="password" id="pass" name="password" placeholder="パスワード" />
          </div>
          <div class="form-submit">
            <button id="loginBtn" class="btn submit">ログイン</button>
            <input type="hidden" name="loginSubmit" value="login">
          </div>
        </form>
      </div>
    </div>
  </main>
  <script src="js/Validation.js"></script>
  <script src="js/Message.js"></script>
  <script src="js/inputCheck.js"></script>
</body>
</html>