<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=”viewport” content=”width=device-width, initial-scale=1”>
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="view/css/style.css">
</head>
<body class="mypage">
  <main>
    <div class="container">
      <div class="top-wrapper">
        <h2>マイページ</h2>
        <a href="index.php?action=login" class="btn top">ログインページに戻る</a>
      </div>
      <div class="regist-wrapper">
        <form action="index.php" method="post">
          <div class="item">
            <label class="label" for="label">名前<span class="label-required">*</span>：</label>
            <label class="label" for="label"><?php echo $_SESSION['name'] ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="編集">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label" for="email">メールアドレス<span class="label-required">*</span>：</label>
            <label class="label" for="label"><?php echo $_SESSION['email']; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="編集">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label" for="pass">パスワード<span class="label-required">*</span>：</label>
            <label class="label" for="label"><?php echo "********" ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="編集">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label">住所：</label>
            <label class="label" for="label"><?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ""; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="編集">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label">生年月日：</label>
            <label class="label" for="label"><?php echo isset($_SESSION['birthday']) ? $_SESSION['birthday'] : ""; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="編集">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label" for="tel">電話番号：</label>
            <label class="label" for="label"><?php echo isset($_SESSION['tel']) ? $_SESSION['tel'] : ""; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="編集">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label">仕事：</label>
            <label class="label" for="label"><?php echo isset($_SESSION['work']) ? $_SESSION['work'] : ""; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="編集">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>