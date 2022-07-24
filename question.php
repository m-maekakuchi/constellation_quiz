<?php
  class Question {

    private $title;             //問題文
    private $options;           //選択肢
    private $correctAnswer;     //正答

    public function __construct($title, $options) {
      $this->title = $title;
      $this->options = $options;
    }

    public function getTitle() {
      return $this->title;
    }

    public function getOptions() {
      return $this->options;
    }

    public function getCorrectAnswer() {
      return $this->correctAnswer;
    }

    public function setCorrectAnswer($correctAnswer) {
      $this->correctAnswer = $correctAnswer;
    }

    //選択肢の順番をシャッフルする
    public function shuffle_array() {
      shuffle($this->options);
    }

  }
?>