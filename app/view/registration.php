<?php
  require_once('utilities/Form.php');

  // try {
  //   $adressDao = createDao("AdressDao");
  //   $worksDao  = createDao("WorksDao");
    // $form      = new Form();

  //   $address   = $adressDao->selectAll();
  //   $works     = $worksDao->selectAll();
  //   $years     = $form->makeItems(1950, 2020);
  //   $months    = $form->makeItems(1, 12);
  //   $days      = $form->makeItems(1, 31);

  //   if (isset($_SESSION['errors'])) {
  //     $errors = $_SESSION['errors'];
  //   }
  // } catch (PDOException $e) {
  //   die ("データベースエラー:".$e->getMessage());
  // } catch (Exception $e) {
  //   echo $e->getMessage(), "例外発生"; 
  // }
  
  $address = $_SESSION['address'];
  $works   = $_SESSION['works'];
  $years   = $_SESSION['years'];
  $months  = $_SESSION['months'];
  $days    = $_SESSION['days'];

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
            <label class="label" for="label">名前<span class="label-required">*</span>：</label>
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
            <label class="label" for="email">メールアドレス<span class="label-required">*</span>：</label>
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
          </div>
          <div class="item">
          <label class="label">住所：</label>
            <select name="address" class="select1">
              <?php
                $options = Form::makeOptions($address, 'address');
                var_dump($options);
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>
          </div>
          <div class="item">
          <label class="label">生年月日：</label>
            <select name="year" class="select1">
              <?php
                $options = Form::makeOptions($years, 'year');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>年
            <select name="month" class="select1">
              <?php
                $options = Form::makeOptions($months, 'month');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>月
            <select name="day" class="select1">
              <?php
                $options = Form::makeOptions($days, 'day');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>日
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
              <?php if (isset($errors['tel']))
                  echo "<span class ='error'>{$errors['tel']}</span>";
              ?>
            </div>
          </div>
          <div class="item">
            <label class="label">仕事：</label>
            <select name="work" class="select2"> 
              <?php
                $options = Form::makeOptions($works, 'work');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>
          </div>
          <div class="form-submit">
            <input type="submit" name="submit" class="btn submit" value="登録する">
            <input type="hidden" name="action" value="complete">
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>