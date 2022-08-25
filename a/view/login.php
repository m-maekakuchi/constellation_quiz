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
        <a href="index.php?action=regist" class="btn top">アカウント登録はこちら</a>
      </div>
      <div class="form-wrapper">
      <?php if(isset($error)) echo "<p class='error'>{$error}</p>"; ?>
        <form action="index.php" method="post">
          <div class="login-form">
            <input type="email" name="email" placeholder="メールアドレス" /><br>          
          </div>
          <div class="login-form">
            <input type="password" name="password" placeholder="パスワード" />
          </div>
          <input type="submit" name="submit" class="btn submit" value="ログイン" />
          <input type="hidden" name="action" value="login">
        </form>
      </div>
    </div>
  </main>
</body>
</html>