
class Validation {

  constructor() {
    this.patternList = [
      /^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/,      //emailの正規表現パターン
      /^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,16}$/i,    //passwordの正規表現パターン、半角英数字それぞれ1つ以上含む
      /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/,       //telの正規表現パターン
    ];
  }
  
  //空文字チェック
  checkEmpty(para) {
    if (!para) {
      return true;    //未入力
    } else {
      
      return false;   //入力値あり
    }
  };
  
  //バリデーションチェック
  checklPattern(property, para) {
    if (!this.patternList[property].test(para)) {
      return true;    //パターンに一致しない
    } else {
      return false;   //パターンに一致
    }
  };

}