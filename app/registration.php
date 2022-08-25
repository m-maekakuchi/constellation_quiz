<?php
  require_once('QuizDao.php');
  require_once('Form.php');
  require_once('Validation.php');
  require_once('common/Message.php');
  // session_start();

  $success   = 0;
  $dao       = null;
  $makeform  = null;
  $checkform = null;
  $failure   = "";
  $year      = "";
  $month     = "";
  $day       = "";
  $errors    = [];

  try {
    $dao     = new QuizDao();
    $form    = new Form();
    $val     = new Validation();
    $address = $dao->selectAddress();
    $works   = $dao->selectWork();
    $years   = $form->makeItems(1950, 2020);
    $months  = $form->makeItems(1, 12);
    $days    = $form->makeItems(1, 31);

    //登録ボタンが押された場合
    if (isset($_POST['submit'])) {

      //入力必須の名前のバリデーションチェック
      if ($val->checkEmpty($_POST['name'])) {
        $errors['name'] = Message::$NAME_EMPTY;
      } else {
        $_SESSION['name'] = $_POST['name'];
        $name = $_SESSION['name'];
      }

      //入力必須のメールアドレスのバリデーションチェック
      if ($val->checkEmpty($_POST['email'])) {
        $errors['email'] = Message::$EMAIL_EMPTY;
      } else if ($val->checklPattern(0, $_POST['email'])) {
        $errors['email'] = Message::$EMAIL_NOT_CORRECT;
      } else {
        $_SESSION['email'] = $_POST['email'];
        $email = $_SESSION['email'];
      }

      //入力必須のパスワードのバリデーションチェック
      if ($val->checkEmpty($_POST['password'])) {
        $errors['password'] = Message::$PASS_EMPTY;
      } else if ($val->checkEmpty($_POST['password_confirm'])) {
        $errors['password_confirm'] = Message::$PASS_CONFIRM_EMPTY;
      } else if ($val->checklPattern(1, $_POST['password'])) {
        $errors['password'] = Message::$PASS_NOT_CORRECT;
      } else if ($_POST['password'] !== $_POST['password_confirm']) {
        $errors['password_confirm'] = Message::$PASS_NOT_EQUAL;
      } else {
        $password = $_POST['password'];
      }

      //入力任意の電話番号のバリデーションチェック
      if (!$val->checkEmpty($_POST['tel'])) {
        if ($val->checklPattern(2, $_POST['tel'])) {
          $errors['tel'] =  Message::$TEL_NO_CORRECT;
        } else {
          $_SESSION['tel'] = $_POST['tel'];
          $tel = $_SESSION['tel'];
        }
      }

      if (!$val->checkEmpty($_POST['address'])) {
        $_SESSION['address'] = $_POST['address'];
        $addr = $_SESSION['address'];
      }

      if (!$val->checkEmpty($_POST['work'])) {
        $_SESSION['work'] = $_POST['work'];
        $work = $_SESSION['work'];
      }

      if (!$val->checkEmpty($_POST['year'])) {
        $_SESSION['year'] = $_POST['year'];
        $year = $_SESSION['year'];
      }

      if (!$val->checkEmpty($_POST['month'])) {
        $_SESSION['month'] = $_POST['month'];
        $month = $_SESSION['month'];
      }

      if (!$val->checkEmpty($_POST['day'])) {
        $_SESSION['day'] = $_POST['day'];
        $day = $_SESSION['day'];
      }

      if ($year != "" && $month != "" && $day != "") {
        $birthday = "{$year}/{$month}/{$day}";
      }

      if (count($errors) == $success) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $usersId = $dao->selectMaxUsersId();
        $nextId = $usersId['id']+1;
        $dao->insertUsers($nextId, $email, $hashed_pass);
        $dao->insertUser_d($nextId, $name, $addr, $birthday, $tel, $work, $nextId);
        header('Location: complete.php');
        exit();
      }
    }
  } catch (PDOException $e) {
    die ("データベースエラー:".$e->getMessage());
  } catch (Exception $e) {
    echo $e->getMessage(), "例外発生"; 
  }
  
  var_dump($errors);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=”viewport” content=”width=device-width, initial-scale=1”>
  <title>簡易星座クイズプログラム</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="regist">
  <main>
    <div class="top-wrapper">
      <h2>アカウント作成</h2>
      <a href="login.php" class="btn top">ログインページに戻る</a>
    </div>
    <div class="regist-wrapper">
      <div class="container">
        <form action="registration.php" method="post">
          <div class="item">
            <label class="label" for="label">名前<span class="label-required">*</span>：</label>
            <div class="item_column">
              <input 
                type="text"
                id="name"
                name="name"
                size="30"
                value="<?php echo isset($name) ? $name : ""; ?>"
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
                value="<?php echo isset($email) ? $email : ""; ?>"
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
                $options = $form->makeOptions($address, 'address');
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
                $options = $form->makeOptions($years, 'year');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>年
            <select name="month" class="select1">
              <?php
                $options = $form->makeOptions($months, 'month');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>月
            <select name="day" class="select1">
              <?php
                $options = $form->makeOptions($days, 'day');
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
                      value="<?php echo isset($tel) ? $tel : ""; ?>"
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
                $options = $form->makeOptions($works, 'work');
                foreach ($options as $option) {
                  echo $option;
                }
              ?>
            </select>
          </div>
          <div class="form-submit">
            <input type="submit" name="submit" class="btn submit" value="登録する">
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>