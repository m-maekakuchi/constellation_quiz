<?php
  if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
  }
  if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
  }
?>
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <title>簡易星座クイズプログラム</title>
  </head>
  <body>
    <header class="bg-primary text-start text-light p-3">
      <h1 class="fs-4">My Admin</h1>
    </header>

    <div class="container mt-5">
      <section class="row">
        <section class="col-md-4 mb-5">
          <div class="list-group">
            <a href="" class="list-group-item list-group-item-action active" aria-current="true">
              <i class="bi bi-table me-1"></i>
              クイズの設問
            </a>
            <a href="view/manageQuiz.php" class="list-group-item list-group-item-action">
              <i class="bi bi-person-fill me-1"></i>
              ユーザー情報
            </a>
          </div>
        </section>
        <section class="col-md-8">
          <form action="index.php" method="post">
            <header class="border-bottom pb-2 mb-3 d-flex align-items-center">
              <h1 class="fs-3 m-0">クイズの問題</h1>
              <button type="submit" class="btn btn-primary btn-sm ms-auto">
                <i class="bi bi-plus"></i>
                追加
              </button>
              <input type="hidden" name="addQuestion" value="addQuestion">
              <input type="hidden" name="action" value="management">
            </header>
            <p>クイズの問題を追加することができます。</p>
            <?php if(isset($_SESSION['message'])) echo "<p class='text-danger'>{$message}</p>"; ?>
            <div class="input-group mb-3">
              <div class="row">
                <!-- <span class="input-group-text">問題文</span> -->
                <textarea name="question" class="form-control" placeholder="問題文" aria-label="Question"></textarea>
                <?php if(isset($errors['question'])) echo "<p class='text-danger mb-0'>{$errors['question']}</p>"; ?>
              </div>
            </div>
            <div class="input-group mb-3">
              <div class="row">
                <!-- <span class="input-group-text" id="basic-addon1">選択肢1</span> -->
                <input type="text" name="choice1" class="form-control" placeholder="選択肢1" aria-label="Choice1" aria-describedby="basic-addon1">
                <?php if(isset($errors['choice1'])) echo "<p class='text-danger'>{$errors['choice1']}</p>"; ?>
              </div>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon2">選択肢2</span>
              <input type="text" name="choice2" class="form-control" placeholder="選択肢2" aria-label="Choice2" aria-describedby="basic-addon2">
              
              <div class="invalid-feedback">
                Please choose a username.
              </div>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">選択肢3</span>
              <input type="text" name="choice3" class="form-control" placeholder="選択肢3" aria-label="Choice3" aria-describedby="basic-addon3">
              <?php if(isset($errors['choice3'])) echo "<p class='text-danger'>{$errors['choice3']}</p>"; ?>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon4">選択肢4</span>
              <input type="text" name="choice4" class="form-control" placeholder="選択肢4" aria-label="Choice4" aria-describedby="basic-addon4">
              <?php if(isset($errors['choice4'])) echo "<p class='text-danger'>{$errors['choice4']}</p>"; ?>
            </div>
            <select name="corrChoice" class="form-select" aria-label="正答">
              <option value="" selected>正答を選んでください</option>
              <option value="1">選択肢1</option>
              <option value="2">選択肢2</option>
              <option value="3">選択肢3</option>
              <option value="4">選択肢4</option>
            </select>
            <?php if(isset($errors['corrChoice'])) echo "<p class='text-danger'>{$errors['corrChoice']}</p>"; ?>
          </form>
        </section>
      </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>