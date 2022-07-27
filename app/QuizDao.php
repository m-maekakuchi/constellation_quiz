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

    // public function insert($answer_dateTime, $correct_rate) {
    //   $sql = "INSERT INTO quiz_result(answer_datetime, correct_rate) VALUES(?,?)";
    //   $statement = $this->db->prepare($sql);
    //   $statement->bindValue(1, $answer_dateTime);
    //   $statement->bindValue(2, $correct_rate);
    //   $statement->execute();
    //   return $statement->rowCount();
    // }

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