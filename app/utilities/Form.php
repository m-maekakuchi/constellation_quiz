<?php
  class Form {

    //セレクトボックスの項目を生成
    public function makeItems($start, $end) {
      $items = [];
      for ($i = $start; $i <= $end; $i++) {
        $items[] = $i;
      }
      return $items;
    }

    //セレクトボックスのoption要素を生成
    public static function makeOptions($list, $key) {
      $options = [];
      array_push($options, '<option value="">選択▼</option>');
      for ($i = 0; $i < count($list); $i++) {
        if ($key == 'work' || $key == 'address'){
          if (isset($_SESSION[$key]) && $list[$i]['id'] == $_SESSION[$key]) {
            array_push($options, "<option value='{$list[$i]['id']}' selected>{$list[$i][$key]}</option>");
          } else {
            array_push($options, "<option value='{$list[$i]['id']}'>{$list[$i][$key]}</option>");
          }
        } else {
          if (isset($_SESSION[$key]) && $list[$i] == $_SESSION[$key]) {
            array_push($options, "<option value='{$list[$i]}' selected>{$list[$i]}</option>");
          } else {
            array_push($options, "<option value='{$list[$i]}'>{$list[$i]}</option>");
          }
        }
      }
      return $options;
    }
  }
