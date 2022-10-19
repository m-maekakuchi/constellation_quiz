<?php
  if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
  }
  if (isset($_REQUEST['message'])) {
    $message = $_REQUEST['message'];
  }
  if (isset($_REQUEST['searchQue'])) {
    $searchQue = $_REQUEST['searchQue'];
  }
  if (isset($_REQUEST['searchChoices'])) {
    $searchChoices = $_REQUEST['searchChoices'];
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
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">My Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php?action=management">ホーム</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=question&tryAgain=tryAgain">クイズ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=mypage">マイページ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=logout">ログアウト</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
      <section class="row">
        <section class="col-md-3 mb-5">
          <div class="list-group">
            <a href="" class="list-group-item list-group-item-action active" aria-current="true">
              <i class="bi bi-table me-1"></i>
              クイズ
            </a>
            <a href="view/manageQuiz.php" class="list-group-item list-group-item-action">
              <i class="bi bi-person-fill me-1"></i>
              ユーザー情報
            </a>
          </div>
        </section>
        <section class="col-md-9">
          <form action="index.php" method="post" class="needs-validation" novalidate>
            <header class="border-bottom pb-2 mb-3 d-flex align-items-center">
              <h1 class="fs-3 m-0">問題の追加</h1>
              <button type="submit" class="btn btn-primary btn-sm ms-auto">
                <i class="bi bi-plus"></i>
                追加
              </button>
              <input type="hidden" name="addQuestion" value="addQuestion">
              <input type="hidden" name="action" value="management">
            </header>
            <?php if(isset($message)) echo "<p class='text-danger'>{$message}</p>"; ?>
            <div class="mb-1">
              <div class="row">
                <div class="mb-1">
                  <label for="questionInput" class="form-label">問題文</label>
                  <textarea class="form-control" name="question" id="questionInput" rows="3" placeholder="北斗七星はある星座のしっぽと言われていますがその星座は？"><?php echo isset($_SESSION['question']) ? $_SESSION['question'] : ""; ?></textarea>
                </div>
                <?php if(isset($errors['question'])) echo "<p class='text-danger mb-0'>{$errors['question']}</p>"; ?>
              </div>
            </div>
            <div class="mb-1">
              <div class="row">
                <div class="mb-1">
                  <label for="choice1" class="form-label">選択肢1</label>
                  <input type="text" name="choice1" class="form-control" id="choice1" placeholder="こいぬ座" value="<?php echo isset($_SESSION['choice1']) ? $_SESSION['choice1'] : ""; ?>">
                </div>
                <?php if(isset($errors['choice1'])) echo "<p class='text-danger'>{$errors['choice1']}</p>"; ?>
              </div>
            </div>
            <div class="mb-1">
              <div class="row">
                <div class="mb-1">
                  <label for="choice2" class="form-label">選択肢2</label>
                  <input type="text" name="choice2" class="form-control" id="choice2" placeholder="おおぐま座" value="<?php echo isset($_SESSION['choice2']) ? $_SESSION['choice2'] : ""; ?>">
                </div>
                <?php if(isset($errors['choice2'])) echo "<p class='text-danger'>{$errors['choice2']}</p>"; ?>
              </div>
            </div>
            <div class="mb-1">
              <div class="row">
                <div class="mb-1">
                  <label for="choice3" class="form-label">選択肢3</label>
                  <input type="text" name="choice3" class="form-control" id="choice3" placeholder="おおいぬ座" value="<?php echo isset($_SESSION['choice3']) ? $_SESSION['choice3'] : ""; ?>">
                </div>
                <?php if(isset($errors['choice3'])) echo "<p class='text-danger'>{$errors['choice3']}</p>"; ?>
              </div>
            </div>
            <div class="mb-2">
              <div class="row">
                <div class="mb-1">
                  <label for="choice4" class="form-label">選択肢4</label>
                  <input type="text" name="choice4" class="form-control" id="choice4" placeholder="こぐま座" value="<?php echo isset($_SESSION['choice4']) ? $_SESSION['choice4'] : ""; ?>">
                </div>
                <?php if(isset($errors['choice4'])) echo "<p class='text-danger'>{$errors['choice4']}</p>"; ?>
              </div>
            </div>
            <div class="mb-2">
              <div class="mb-1">
                <label for="choice4" class="form-label">正しい選択肢</label>
                <select name="corrChoice" class="form-select" aria-label="正答">
                  <option value="">選んでください</option>
                  <?php 
                  for ($i = 1; $i <= 4; $i++) {
                    $option = "<option value={$i} ";
                    if (isset($_SESSION['corrChoice']) && $_SESSION['corrChoice'] == $i) {
                      $option .= "selected";
                    }
                    $option.= ">選択肢{$i}</option>";
                    echo $option;
                  }
                  ?>
                </select>
              </div>
              <?php if(isset($errors['corrChoice'])) echo "<p class='text-danger'>{$errors['corrChoice']}</p>"; ?>
            </div>
          </form>
          <form action="index.php" method="post" class="needs-validation mt-5" novalidate>
            <header class="border-bottom pb-2 mb-3 d-flex align-items-center">
              <h1 class="fs-3 m-0">問題の検索</h1>
              <button type="submit" class="btn btn-primary btn-sm ms-auto">
                <i class="bi bi-search"></i>
                検索
              </button>
              <input type="hidden" name="searchQuestion" value="searchQuestion">
              <input type="hidden" name="action" value="management">
            </header>
            <div class="mb-1">
              <div class="row">
                <div class="mb-1">
                  <label for="questionInput" class="form-label">問題文</label>
                  <input type="text" name="searchQue" class="form-control" id="searchQue" placeholder="北斗七星" value="<?php echo isset($_SESSION['searchQue']) ? $_SESSION['searchQue'] : ""; ?>">
                </div>
                <?php if(isset($errors['question'])) echo "<p class='text-danger mb-0'>{$errors['question']}</p>"; ?>
              </div>
            </div>
          </form>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">question</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
                <th scope="col">&emsp;&emsp;&emsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>次の星座のうち、日本からは全く見えない星座はどれでしょう？</td>
                <td>かんむり座</td>
                <td class=".text-nowrap">りょうけん座</td>
                <td>りょうけん座</td>
                <td>りょうけん座</td>
                <td><button type="button" class="btn btn-primary btn-sm .text-nowrap" >変更</button></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@fat</td>
                <td>@fat</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry the Bird</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
        </section>
      </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>