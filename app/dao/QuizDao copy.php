<?php
  class QuizDao {
    private $db;

    public function __construct() {
      $dsn = 'mysql:dbname=quiz;host=localhost;charset=utf8';
      $user ='root';
      $password ="root";
      $this->db = new PDO($dsn, $user, $password);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function close() {
      $this->db = null;
    }

    //問題数を取得
    public function selectQuestionNum() {
      $sql = "SELECT
                COUNT(*) AS questions_num
              FROM
                questions";
      $stt = $this->db->prepare($sql);
      $stt->execute();
      return $stt->fetchColumn();
    }

    //問題文と選択肢を取得
    public function selectContents() {
      $sql = "SELECT
                q.id AS QUESTION_ID,
                q.content AS QUESTION,
                c.id AS CHOICE_ID,
                c.content AS OPTIONS
              FROM
                questions q
              JOIN choices c ON
                q.id = c.questions_id";
      $stt = $this->db->prepare($sql);
      $stt->execute();
      //連想配列の形でレコード群を1つの配列に格納
      $all = $stt->fetchAll(PDO::FETCH_ASSOC);

      $contents = [];
      $content = [];
      $loop = 0;
      for ($i = 0; $i < count($all); $i++) {
        $loop++;
        if ($i % 4 === 0) {
          $content['QUESTION_ID'] = $all[$i]['QUESTION_ID'];
          $content['QUESTION'] = $all[$i]['QUESTION'];
        }
        $content['CHOICE_ID'][] = $all[$i]['CHOICE_ID'];
        $content['OPTIONS'][] = $all[$i]['OPTIONS'];

        if ($loop == 4) {
          array_push($contents, $content);
          $content = [];
          $loop = 0;
        }
      }
      return $contents;
    }

    // ユーザーの選択肢が合っているか
    public function checkAnswer($choices_id1, $choices_id2, $choices_id3) {
      $sql = "SELECT
                questions_id,
                result_flg
              FROM
                choices
              WHERE
                id IN (?, ?, ?);";
      $stt = $this->db->prepare($sql);
      $stt->bindValue(1, $choices_id1);
      $stt->bindValue(2, $choices_id2);
      $stt->bindValue(3, $choices_id3);
      $stt->execute();
      $row = $stt->fetchAll(PDO::FETCH_ASSOC);
      return $row;
    }

    //ユーザーの回答を登録
    public function insertUserAnswer($username, $choices_id1, $choices_id2, $choices_id3) {
      $sql = "INSERT INTO answer_history(username, choices_id1, choices_id2, choices_id3)
              VALUES(?, ?, ?, ?);";
      $stt = $this->db->prepare($sql);
      $stt->bindValue(1, $username);
      $stt->bindValue(2, $choices_id1);
      $stt->bindValue(3, $choices_id2);
      $stt->bindValue(4, $choices_id3);
      $stt->execute();
      return $stt->rowCount();
    }

    //アカウントが登録されているか
    public function selectUserId($email) {
      $sql = "SELECT
                id,
                password
              FROM
                users
              WHERE
                email = ?;";
      $stt = $this->db->prepare($sql);
      $stt->bindValue(1, $email);
      $stt->execute();
      return $stt->fetch(PDO::FETCH_ASSOC);
    }

    //ログインされたアカウント情報を取り出す
    public function selectUserInfo($userId) {
      $sql = "SELECT
                d.name AS name,
                u.email AS email,
                u.password AS password,
                a.address AS address,
                d.birthday AS birthday,
                d.tel AS tel,
                w.work AS work
              FROM
                users u
              LEFT JOIN user_detail d ON
                u.id = d.users_id
              LEFT JOIN addresss a ON
                d.address_id = a.id
              LEFT JOIN works w ON
                d.works_id = w.id
              WHERE
                users_id = ?;";
      $stt = $this->db->prepare($sql);
      $stt->bindValue(1, $userId);
      $stt->execute();
      return $stt->fetch(PDO::FETCH_ASSOC);
    }

    //住所一覧を取得
    public function selectAddress() {
      $sql = "SELECT
                *
              FROM
                addresss;";
      $stt = $this->db->prepare($sql);
      $stt->execute();
      return $stt->fetchAll(PDO::FETCH_ASSOC);
    }

    //仕事一覧を取得
    public function selectWork() {
      $sql = "SELECT
                *
              FROM
                works;";
      $stt = $this->db->prepare($sql);
      $stt->execute();
      return $stt->fetchAll(PDO::FETCH_ASSOC);
    }

    //usersテーブルのmaxのidを取得
    public function selectMaxUsersId() {
      $sql = "SELECT
                  MAX(id) AS id
              FROM
                  users;";
      $stt = $this->db->prepare($sql);
      $stt->execute();
      return $stt->fetch(PDO::FETCH_ASSOC);
    }

    //アカウント登録
    public function insertUsers($id, $email, $password) {
      $sql = "INSERT INTO users(id, email, password)
              VALUES(?, ?, ?);";
      $stt = $this->db->prepare($sql);
      $stt->bindValue(1, $id);
      $stt->bindValue(2, $email);
      $stt->bindValue(3, $password);
      $stt->execute();
      return $stt->fetchAll(PDO::FETCH_ASSOC);
    }

    //アカウント詳細登録
    public function insertUser_d($id, $name, $address_id, $birthday, $tel, $works_id, $users_id) {
      $sql = "INSERT INTO user_detail(
                id,
                name,
                address_id,
                birthday,
                tel,
                works_id,
                users_id
              )
              VALUES(?, ?, ?, ?, ?, ?, ?);";
      $stt = $this->db->prepare($sql);
      $stt->bindValue(1, $id);
      $stt->bindValue(2, $name);
      $stt->bindValue(3, $address_id);
      $stt->bindValue(4, $birthday);
      $stt->bindValue(5, $tel);
      $stt->bindValue(6, $works_id);
      $stt->bindValue(7, $users_id);
      $stt->execute();
      return $stt->fetchAll(PDO::FETCH_ASSOC);
    }

  }
?>