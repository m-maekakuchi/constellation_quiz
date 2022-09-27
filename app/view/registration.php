<?php
    if (isset($_SESSION['errors'])) {
      $errors = $_SESSION['errors'];
    }
    $dateArray = ["year" => "年", "month" => "月", "day" => "日"];
    $keys = array_keys($dateArray);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=”viewport” content=”width=device-width, initial-scale=1”>
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="view/css/style.css">
</head>
<body class="regist">
  <main>
    <div class="container">
      <div class="top-wrapper">
        <h2>アカウント作成</h2>
        <a href="index.php?action=login" class="btn top">ログインページに戻る</a>
      </div>
      <div class="regist-wrapper">
        <form action="index.php" method="post">
          <div class="item">
            <label class="label-item" for="label">名前<span class="label-required">*</span>：</label>
            <div class="item_column">
              <input 
                type="text"
                id="name"
                name="name"
                size="30"
                value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ""; ?>"
              />
              <?php if (isset($errors['name']))
                echo "<span class ='error'>{$errors['name']}</span>";
              ?>
            </div>
          </div>
          <div class="item">
            <label class="label-item" for="email">メールアドレス<span class="label-required">*</span>：</label>
            <div class="item_column">
              <input
                type="text"
                id="email"
                name="email"
                placeholder="example@gmail.com"
                size="30"
                value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; ?>"
              />
              <?php if (isset($errors['email']))
                echo "<span class ='error'>{$errors['email']}</span>";
              ?>
            </div>
          </div>
          <div class="item">
            <label class="label-item" for="pass">パスワード<span class="label-required">*</span>：</label>
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
            <label class="label-item" for="pass_confirm">パスワード確認用<span class="label-required">*</span>：</label>
            <div class="item_column">
              <input type="password" id="pass_confirm" name="password_confirm" size="30"/>
              <?php if (isset($errors['password_confirm']))
                  echo "<span class ='error'>{$errors['password_confirm']}</span>";
              ?>
            </div>
          </div>
          <div class="item">
          <label class="label-item">住所：</label>
            <select name="address" class="select1">
              <?php
                $options = Form::makeOptions($_SESSION['addresss'], 'address');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>
          </div>
          <div class="item">
            <label class="label-item">生年月日：</label>
            <?php
              for ($i = 0; $i < count($dateArray); $i++) {
                $key = $keys[$i];
                $variable = $key."s";
                echo "<select name='{$key}' class='select1'>";
                $options = Form::makeOptions($_SESSION[$variable], $key);
                foreach ($options as $option) {
                  echo $option;
                }
                echo "</select>".$dateArray[$key]."&nbsp;";
              }
            ?>
            
          </div>
          <div class="item">
            <label class="label-item" for="tel">電話番号：</label>
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
          </div>
          <div class="item">
            <label class="label-item">仕事：</label>
            <select name="work" class="select2"> 
              <?php
                $options = Form::makeOptions($_SESSION['works'], 'work');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>
          </div>
          <div class="form-submit">
            <input type="submit" name="submit" class="btn submit" value="登録する">
            <input type="hidden" name="action" value="registration">
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>