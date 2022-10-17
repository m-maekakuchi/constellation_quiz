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
              <a class="nav-link active" aria-current="page" href="">ホーム</a>
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
        <section class="col-md-4 mb-5">
          <div class="list-group">
            <a href="../index.php?action=management" class="list-group-item list-group-item-action">
              <i class="bi bi-table me-1"></i>
              クイズの設問
            </a>
            <a href="" class="list-group-item list-group-item-action active" aria-current="true">
              <i class="bi bi-person-fill me-1"></i>
              ユーザー情報
            </a>
          </div>
        </section>
        <section class="col-md-8">
          <header class="border-bottom pb-2 mb-3 d-flex align-items-center">
            <h1 class="fs-3 m-0">ユーザー情報</h1>
          </header>
          <p>現在、登録しているユーザーに関する情報です。</p>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">mail</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <!-- <td colspan="2">Larry the Bird</td> -->
                <td>Larry the Bird</td>
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