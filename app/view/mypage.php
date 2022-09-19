<?php
    if (isset($_SESSION['errors'])) {
      $errors = $_SESSION['errors'];
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
<body class="mypage">
  <main>
    <div class="container">
      <div class="top-wrapper">
        <h2>マイページ</h2>
        <a href="index.php?action=login" class="btn top">ログアウト</a>
      </div>
      <div class="regist-wrapper">
        <?php if (isset($_SESSION['message'])) echo "<p class='update'>{$_SESSION['message']}</p>"; ?>
        <form action="index.php" method="post">
          <div class="item">
            <label class="label-item" for="label">名前：</label>
            <label class="label-form" for="label">
              <div class="item_column">
                <input 
                  type="text"
                  id="name"
                  name="name"
                  size="30"
                  value="<?php echo $_SESSION['name']?>"
                />
                <?php if (isset($errors['name']))
                  echo "<span class ='error'>{$errors['name']}</span>";
                ?>
              </div>
            </label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="更新">
              <input type="hidden" name="action" value="mypage">
              <input type="hidden" name="item" value="name">
            </div>
          </div>
        </form>
        <form action="index.php" method="post">
          <div class="item">
            <label class="label-item" for="email">メールアドレス：</label>
            <label class="label-form" for="email">
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
            </label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="更新">
              <input type="hidden" name="action" value="mypage">
              <input type="hidden" name="item" value="email">
            </div>
          </div>
        </form>
        <form action="index.php" method="post">
          <div class="item">
            <label class="label-item" for="pass">パスワード：</label>
            <label class="label-form" for="pass">
              <div class="item_column">
                <input
                  type="password"
                  id="pass"
                  name="password"
                  placeholder="8文字以上16文字以内の半角英数字"
                  size="30"
                />
                <?php if (isset($errors['password']))
                    echo "<span class ='error'>{$errors['password']}</span>";
                ?>
              </div>
            </label>
          </div>
          <div class="item">
            <label class="label-item" for="pass_confirm">パスワード確認用：</label>
            <label class="label-form" for="pass_confirm">
              <div class="item_column">
                <input type="password" id="pass_confirm" name="password_confirm" size="30"/>
                <?php if (isset($errors['password_confirm']))
                    echo "<span class ='error'>{$errors['password_confirm']}</span>";
                ?>
              </div>
            </label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="更新">
              <input type="hidden" name="action" value="mypage">
              <input type="hidden" name="item" value="password">
            </div>
          </div>
        </form>
        <form action="index.php" method="post">
          <div class="item">
            <label class="label-item">住所：</label>
            <label class="label-form">
              <div class="item_column">
                <select name="address" class="select1">
                  <?php
                    $options = Form::makeOptions($_SESSION['addresss'], 'address');
                    foreach ($options as $option) {
                      echo $option;
                    }
                  ?>
                </select>
                <?php if (isset($errors['address']))
                    echo "<span class ='error'>{$errors['address']}</span>";
                ?>
              </div>
            </label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="更新">
              <input type="hidden" name="action" value="mypage">
              <input type="hidden" name="item" value="address">
            </div>
          </div>
        </form>
        <form action="index.php" method="post">
          <div class="item">
            <label class="label-item">生年月日：</label>
            <label class="label-form">
              <?php if(isset($_SESSION['birthday'])) : ?>
                <?php echo $_SESSION['birthday']; ?>
              <?php else : ?>
                <div class="item_column">
                  <div class="unity">
                    <select name="year" class="select1">
                      <?php
                        $options = Form::makeOptions($_SESSION['years'], 'year');
                        foreach ($options as $option) {
                          echo $option;
                        }
                      ?>
                    </select>年&nbsp;
                    <select name="month" class="select1">
                      <?php
                        $options = Form::makeOptions($_SESSION['months'], 'month');
                        foreach ($options as $option) {
                          echo $option;
                        }
                      ?>
                    </select>月&nbsp;
                    <select name="day" class="select1">
                      <?php
                        $options = Form::makeOptions($_SESSION['days'], 'day');
                        foreach ($options as $option) {
                          echo $option;
                        }
                      ?>
                    </select>日
                  </div>
                  <?php if (isset($errors['birthday']))
                    echo "<span class ='error'>{$errors['birthday']}</span>";
                  ?>
                </div>
              </label>
              <div class="form-submit">
                <input type="submit" name="submit" class="btn submit" value="更新">
                <input type="hidden" name="action" value="mypage">
                <input type="hidden" name="item" value="birthday">
              </div>
            <?php endif; ?>
          </div>
        </form>
        <form action="index.php" method="post">
          <div class="item">
            <label class="label-item" for="tel">電話番号：</label>
            <label class="label-form" for="tel">
              <div class="item_column">
                <input type="text"
                        id="tel"
                        name="tel"
                        size = "30"
                        value="<?php echo isset($_SESSION['tel']) ? $_SESSION['tel'] : ""; ?>"
                        placeholder="000-0000-0000"
                />
                <?php if (isset($errors['tel']))
                    echo "<span class ='error'>{$errors['tel']}</span>";
                ?>
              </div>
            </label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="更新">
              <input type="hidden" name="action" value="mypage">
              <input type="hidden" name="item" value="tel">
            </div>
          </div>
        </form>
        <form action="index.php" method="post">
          <div class="item">
            <label class="label-item">仕事：</label>
            <label class="label-form">
              <div class="item_column">
                <select name="work" class="select2"> 
                  <?php
                    $options = Form::makeOptions($_SESSION['works'], 'work');
                    foreach ($options as $option) {
                      echo $option;
                    }
                  ?>
                </select>
                <?php if (isset($errors['work']))
                      echo "<span class ='error'>{$errors['work']}</span>";
                ?>
              </div>
            </label>
            <div class="form-submit">
              <input type="submit" name="submit" class="btn submit" value="更新">
              <input type="hidden" name="action" value="mypage">
              <input type="hidden" name="item" value="work">
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>