<?php
  class QuizDao {
    private $db;

    public function __construct() {
      $dsn = 'mysql:dbname=heroku_c4a85b99b211ade;host=us-cdbr-east-06.cleardb.net;charset=utf8';
      $user ='b7195eb6df8b24';
      $password ="1148410a";
      $driver_options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone='+09:00'"];
      $this->db = new PDO($dsn, $user, $password, $driver_options);
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

    // public function selectByTime($date1, $date2) {
    //   $sql = "SELECT * FROM quiz_result WHERE answer_datetime BETWEEN ? AND ?";
    //   $stt = $this->db->prepare($sql);
    //   $stt->bindValue(1, $date1);
    //   $stt->bindValue(2, $date2);
    //   $stt->execute();
    //   $rows = [];
    //   while($row = $stt->fetch(PDO::FETCH_ASSOC)) {
    //     $rows[] = $row;
    //   }
    //   return $rows;
    // }
  }
?>