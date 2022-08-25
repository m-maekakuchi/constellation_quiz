<?php
  require_once('QuizDao.php');
  require_once('Form.php');
  require_once('Validation.php');
  // session_start();

  $valCount     = 0;
  $success      = 0;
  $dao          = null;
  $makeform     = null;
  $checkform    = null;
  $failure      = "";
  $url          = 'http://localhost/marie/quiz/app/complete.php';

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
        $valCount++;
      } else {
        $_SESSION['name'] = $_POST['name'];
        $name = $_SESSION['name'];
      }

      //入力必須のメールアドレスのバリデーションチェック
      if ($val->checkEmpty($_POST['email'])) {
        $valCount++;
      } else if ($val->checklPattern(0, $_POST['email'])) {
        $valCount++;
      } else {
        $_SESSION['email'] = $_POST['email'];
        $email = $_SESSION['email'];
      }

      //入力必須のパスワードのバリデーションチェック
      if ($val->checkEmpty($_POST['password'])) {
        $valCount++;
      } else if ($val->checklPattern(1, $_POST['password'])) {
        $valCount++;
      } else {
        $password = $_POST['password'];
      }

      //入力任意の電話番号のバリデーションチェック
      if (!$val->checkEmpty($_POST['tel'])) {
        if ($val->checklPattern(2, $_POST['tel'])) {
          $valCount++;
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

      if ($year != null && $month != null && $day != null) {
        $birthday = "{$year}/{$month}/{$day}";
      }

      if ($valCount == $success) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $usersId = $dao->selectMaxUsersId();
        $nextId = $usersId['id']+1;
        $dao->insertUsers($nextId, $email, $hashed_pass);
        $dao->insertUser_d($nextId, $name, $addr, $birthday, $tel, $work, $nextId);
        header('Location: '.$url);
        exit();
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
      <h2>アカウント作成</h2>
  </header>
  <main>
    <!-- <?php
      if ($failure != "") {
        echo $failure;
      }
    ?> -->
    <form action="registration.php" method="post">
      <div class="item">
        <label for="name">名前（必須）：</label>
        <input 
          type="text"
          id="name"
          name="name"
          value="<?php echo isset($name) ? $name : ""; ?>"
        />
      </div>
      <div class="item">
        <label for="text">メールアドレス（必須）：</label>
        <input
          type="email"
          id="email"
          name="email"
          value="<?php echo isset($email) ? $email : ""; ?>"
        />
      </div>
      <div class="item">
        <label for="pass">パスワード（必須）：</label>
        <input type="password" id="pass" name="password" />
      </div>
      <div class="item">
        住所：
        <select name="address">
          <?php
            $options = $form->makeOptions($address, 'address');
            foreach ($options as $option) {
              echo $option;
            }
          ?>
        </select>
      </div>
      <div class="item">
        生年月日：
        <select name="year">
          <?php
            $options = $form->makeOptions($years, 'year');
            foreach ($options as $option) {
              echo $option;
            }
          ?>
        </select>年
        <select name="month">
          <?php
            $options = $form->makeOptions($months, 'month');
            foreach ($options as $option) {
              echo $option;
            }
          ?>
        </select>月
        <select name="day">
          <?php
            $options = $form->makeOptions($days, 'day');
            foreach ($options as $option) {
              echo $option;
            }
          ?>
        </select>日
      </div>
      <div class="item">
        <label for="tel">電話番号：</label>
        <input type="text"
                id="tel"
                name="tel"
                value="<?php echo isset($tel) ? $tel : ""; ?>"
        />
      </div>
      <div class="item">
        仕事：
        <select name="work">
          <?php
            $options = $form->makeOptions($works, 'work');
            foreach ($options as $option) {
              echo $option;
            }
          ?>
        </select>
      </div>
      <div class = "btn">
        <input type="submit" name="submit" class="submit" value="登録">
      </div>
    </form>
  </main>
</body>
</html>