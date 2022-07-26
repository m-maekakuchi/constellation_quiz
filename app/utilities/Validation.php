<?php
  class Validation {

    private $patternList = ['/^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/',        //emailの正規表現パターン
                            '/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,16}$/i',      //passwordの正規表現パターン、半角英数字それぞれ1つ以上含む
                            '/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/'          //telの正規表現パターン
                            ];
    
    //空文字チェック
    public function checkEmpty($para) {
			if (empty($para)) {
				//未入力
				return true;
			} else {
				//入力値あり
				return false;
			}
    }
    
    //バリデーションチェック
    public function checklPattern($flg, $para) {
			if (!preg_match($this->patternList[$flg], $para)) {
				//パターンに一致しない
				return true;
			} else {
				//パターンに一致
				return false;
			}
    }

  }