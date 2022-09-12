<?php
    if (isset($_SESSION['errors'])) {
      $errors = $_SESSION['errors'];
    }

    echo $_SESSION['address'];
    echo $_SESSION['birthday'];
    echo $_SESSION['tel'];
    echo $_SESSION['work'];
?>

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
        <div class="regist-wrapper">
        <form action="index.php" method="post">
          <div class="item">
            <label class="label" for="label">名前<span class="label-required">*</span>：</label>
            <div class="item_column">
              <input 
                type="text"
                id="name"
                name="name"
                size="30"
                value="<?php echo $_SESSION['name']; ?>"
              />
              <?php if (isset($errors['name']))
                echo "<span class ='error'>{$errors['name']}</span>";
              ?>
            </div>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label" for="email">メールアドレス<span class="label-required">*</span>：</label>
            <div class="item_column">
              <input
                type="text"
                id="email"
                name="email"
                size="30"
                value="<?php echo $_SESSION['email']; ?>"
              />
              <?php if (isset($errors['email']))
                echo "<span class ='error'>{$errors['email']}</span>";
              ?>
            </div>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label" for="pass">パスワード<span class="label-required">*</span>：</label>
            <div class="item_column">
              <input
                type="password"
                id="pass"
                name="password"
                placeholder="8文字以上16文字以内の半角英数字"
                size="30"/>
              <?php if (isset($errors['password']))
                  echo "<span class ='error'>{$errors['password']}</span>";
              ?>
            </div>
          </div>
          <div class="item">
            <label class="label" for="pass_confirm">パスワード確認用<span class="label-required">*</span>：</label>
            <div class="item_column">
              <input type="password" id="pass_confirm" name="password_confirm" size="30"/>
              <?php if (isset($errors['password_confirm']))
                  echo "<span class ='error'>{$errors['password_confirm']}</span>";
              ?>
            </div>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label">住所：</label>
            <select name="address" class="select1">
              <?php
                $options = Form::makeOptions($_SESSION['addresss'], 'address');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>
            <!-- <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div> -->
          </div>
          <div class="item">
            <label class="label">生年月日：</label>
            <?php echo isset($_SESSION['birthday']) ? $_SESSION['birthday'] : ""; ?>
          </div>
          <div class="item">
            <label class="label" for="tel">電話番号：</label>
            <div class="item_column">
              <input type="text"
                      id="tel"
                      name="tel"
                      size = "30"
                      value="<?php echo isset($_SESSION['tel']) ? $_SESSION['tel'] : ""; ?>"
                      placeholder="000-0000-0000"
              />
            </div>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label">仕事：</label>
            <select name="work" class="select2"> 
              <?php
                $options = Form::makeOptions($_SESSION['works'], 'work');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
        </form>
      </div>
          <div class="item">
            <label class="label" for="label">名前<span class="label-required">*</span>：</label>
            <label class="label" for="label"><?php echo $_SESSION['name'] ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label" for="email">メールアドレス<span class="label-required">*</span>：</label>
            <label class="label" for="label"><?php echo $_SESSION['email']; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label" for="pass">パスワード<span class="label-required">*</span>：</label>
            <label class="label" for="label"><?php echo "********" ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label">住所：</label>
            <label class="label" for="label"><?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ""; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label">生年月日：</label>
            <label class="label" for="label"><?php echo isset($_SESSION['birthday']) ? $_SESSION['birthday'] : ""; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label" for="tel">電話番号：</label>
            <label class="label" for="label"><?php echo isset($_SESSION['tel']) ? $_SESSION['tel'] : ""; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
          <div class="item">
            <label class="label">仕事：</label>
            <label class="label" for="label"><?php echo isset($_SESSION['work']) ? $_SESSION['work'] : ""; ?></label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="確定">
              <input type="hidden" name="action" value="mypage">
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>