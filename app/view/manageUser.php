<?php
  if (isset($_REQUEST['users'])) {
    $users = $_REQUEST['users'];
    $userNum = count($users);
  }
  if (isset($_REQUEST['message'])) {
    $message = $_REQUEST['message'];
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
              <a class="nav-link" href="index.php?action=question">クイズ</a>
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
            <a href="index.php?action=manageQuiz" class="list-group-item list-group-item-action">
              <i class="bi bi-table me-1"></i>
              クイズ
            </a>
            <a href="index.php?action=manageUser" class="list-group-item list-group-item-action active" aria-current="true">
              <i class="bi bi-person-fill me-1"></i>
              ユーザー情報
            </a>
          </div>
        </section>
        <section class="col-md-9">
          <form action="index.php" method="post" class="needs-validation" novalidate>
            <header class="border-bottom pb-2 mb-3 d-flex align-items-center">
              <h1 class="fs-3 m-0">ユーザー情報</h1>
              <button type="submit" class="btn btn-primary btn-sm ms-auto">
                <i class="bi bi-search"></i>
                検索
              </button>
              <input type="hidden" name="searchUser" value="searchUser">
              <input type="hidden" name="action" value="manageUser">
            </header>
            <div class="row">
              <div class="input-group mb-3">
                <span class="input-group-text" id="name">名前</span>
                <input type="text" name="name" class="form-control" value="<?php echo isset($_REQUEST['name']) ? $_REQUEST['name'] : ""; ?>" aria-label="name" aria-describedby="name">
              </div>
              <?php if(isset($errors['question'])) echo "<p class='text-danger mb-0'>{$errors['question']}</p>"; ?>
            </div>
          </form>
          <?php if(isset($message)) echo "<p class='text-danger mb-0'>{$message}</p>"; ?>
          <?php if(isset($users)): ?>
            <form action="index.php" method="post" class="needs-validation" novalidate>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">名前</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i = 0; $i < $userNum; $i++): ?>
                    <tr>
                      <th scope="row" ><?php echo $i+1 ?></th>
                      <td><?php echo $users[$i]['name'] ?></td>
                      <td><?php echo $users[$i]['email'] ?></td>
                      <td class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm .text-nowrap">管理者にする</button>
                        <input type="hidden" name="addAdmin" value="addAdmin">
                        <input type="hidden" name="userId" value="<?php echo $users[$i]['id']?>">
                        <input type="hidden" name="action" value="manageUser">
                      </td>
                    </tr>
                  <?php endfor; ?>
                </tbody>
              </table>
            </form>
          <?php endif; ?>
        </section>
      </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>