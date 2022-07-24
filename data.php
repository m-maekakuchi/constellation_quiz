<?php
  require_once('question.php');

  //第1問目
  $title1 = '北斗七星はある星座のしっぽと言われていますが、その星座は？';
  $options1 = ['おおぐま座', 'こいぬ座', 'おおいぬ座', 'こぐま座'];
  $question1 = new Question($title1, $options1);
  $question1->setCorrectAnswer($options1[0]);
  $question1->shuffle_array();

  //第2問目
  $title2 = 'この中で一番明るい星はどれでしょう？';
  $options2 = ['シリウス', 'スピカ', 'プロキオン', 'ベテルギウス'];
  $question2 = new Question($title2, $options2);
  $question2->setCorrectAnswer($options2[0]);
  $question2->shuffle_array();

  //第3問目
  $title3 = 'アルクトゥルスは何座の中にある星？';
  $options3 = ['うしかい座', 'かんむり座', 'りょうけん座', 'ケンタウルス座'];
  $question3 = new Question($title3, $options3);
  $question3->setCorrectAnswer($options3[0]);
  $question3->shuffle_array();

  $questions = [$question1, $question2, $question3];
?>