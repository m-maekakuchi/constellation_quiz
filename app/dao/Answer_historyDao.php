<?php
require_once ("dao/Dao.php");

class Answer_historyDao extends Dao {
  /**
	 * answer_history
	 * 
	 * @return レコード数
	 */
  public function checkAnswer($choices_id1, $choices_id2, $choices_id3, $choices_id4, $choices_id5, $choices_id6, $choices_id7, $choices_id8, $choices_id9, $choices_id10) {
    $this->open();
    $sql = "SELECT
              questions_id,
              result_flg
            FROM
              choices
            WHERE
              id IN (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stt = $this->prepare($sql);
    $stt->bindValue(1, $choices_id1);
    $stt->bindValue(2, $choices_id2);
    $stt->bindValue(3, $choices_id3);
    $stt->bindValue(4, $choices_id4);
    $stt->bindValue(5, $choices_id5);
    $stt->bindValue(6, $choices_id6);
    $stt->bindValue(7, $choices_id7);
    $stt->bindValue(8, $choices_id8);
    $stt->bindValue(9, $choices_id9);
    $stt->bindValue(10, $choices_id10);
    $stt->execute();
    $row = $stt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  /**
	 * answer_history表に回答を登録
	 * 
	 * @return 登録した行数
	 */
  public function insert($users_id, $choices_id1, $choices_id2, $choices_id3, $choices_id4, $choices_id5, $choices_id6, $choices_id7, $choices_id8, $choices_id9, $choices_id10) {
    $this->open();
    $sql = "INSERT INTO answer_history(users_id, 
                                      choices_id1,
                                      choices_id2,
                                      choices_id3,
                                      choices_id4,
                                      choices_id5,
                                      choices_id6,
                                      choices_id7,
                                      choices_id8,
                                      choices_id9,
                                      choices_id10)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stt = $this->prepare($sql);
    $stt->bindValue(1, $users_id);
    $stt->bindValue(2, $choices_id1);
    $stt->bindValue(3, $choices_id2);
    $stt->bindValue(4, $choices_id3);
    $stt->bindValue(5, $choices_id4);
    $stt->bindValue(6, $choices_id5);
    $stt->bindValue(7, $choices_id6);
    $stt->bindValue(8, $choices_id7);
    $stt->bindValue(9, $choices_id8);
    $stt->bindValue(10, $choices_id9);
    $stt->bindValue(11, $choices_id10);
    $stt->execute();
    return $stt->rowCount();
  }
}