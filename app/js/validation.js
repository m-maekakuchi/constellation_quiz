
class Validation {

  constructor() {
    this.patternList = [
      /^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/,      //emailの正規表現パターン
      /^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,16}$/i,    //passwordの正規表現パターン、半角英数字それぞれ1つ以上含む
      /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/,       //telの正規表現パターン
    ];
  };
  
  //空文字チェック
  checkEmpty(para) {
    if (!para) {
      return true;    //未入力
    } else {
      
      return false;   //入力値あり
    }
  };
  
  //パターンチェック
  checklPattern(property, para) {
    if (!this.patternList[property].test(para)) {
      return true;    //パターンに一致しない
    } else {
      return false;   //パターンに一致
    }
  };

  //名前のバリデーション
  validateName(nameNode) {
    if (this.checkEmpty(nameNode.value)) {
      this.displayError(nameNode, Message.VAL_NAME_EMPTY);
      return 1;
    } else {
      this.removeError(nameNode);
      return 0;
    }
  };

  //メールアドレスのバリデーション
  validateEmail(emailNode) {
    if (this.checkEmpty(emailNode.value)) {
      this.displayError(emailNode, Message.VAL_EMAIL_EMPTY);
      return 1;
    } else if (this.checklPattern(0, emailNode.value)) {
      this.displayError(emailNode, Message.VAL_EMAIL_NOT_CORRECT);
      return 1;
    } else {
      this.removeError(emailNode);
      return 0;
    }
  };

  //ログイン時のパスワードのバリデーション
  validateLoginPass(passNode) {
    if (this.checkEmpty(passNode.value)) {
      this.displayError(passNode, Message.VAL_PASS_EMPTY);
      return 1;
    } else {
      this.removeError(passNode);
      return 0;
    }
  };

  //アカウント登録時のパスワードのバリデーション
  validateRegistPass(passNode, passConfirmNode) {
    if (this.checkEmpty(passNode.value)) {
      this.displayError(passNode, Message.VAL_PASS_EMPTY);
      return 1;
    } else if (this.checkEmpty(passConfirmNode.value)) {
      this.displayError(passConfirmNode, Message.VAL_PASS_CONFIRM_EMPTY);
      this.removeError(passNode);
      return 1;
    } else if (this.checklPattern(1, passNode.value)) {
      this.displayError(passNode, Message.VAL_PASS_NOT_CORRECT);
      this.removeError(passConfirmNode);
      return 1;
    } else if (passNode.value !== passConfirmNode.value) {
      this.displayError(passConfirmNode, Message.VAL_PASS_NOT_EQUAL);
      this.removeError(passNode);
      return 1;
    } else {
      this.removeError(passNode);
      this.removeError(passConfirmNode);
      return 0;
    }
  };

  //住所のバリデーション
  validateAddress(addressNode) {
    if(this.checkEmpty(addressNode.value)) {
      this.displayError(addressNode, Message.VAL_ADDRESS_NOT_SELECT);
      return 1;
    } else {
      this.removeError(addressNode);
      return 0;
    }
  };

  //生年月日のバリデーション
  validateBirthday(yearNode, monthNode, dayNode) {
    const divBirthday = document.getElementById('selectBirthday');
    if (this.checkEmpty(yearNode.value) || this.checkEmpty(monthNode.value) || this.checkEmpty(dayNode.value)) {
      this.displayError(divBirthday, Message.VAL_BIRTHDAY_NOT_SELECT);
      return 1;
    } else {
      this.removeError(divBirthday);
      return 0;
    }
  }

  //電話番号のバリデーション
  validateTel(telNode) {
    if (this.checkEmpty(telNode.value)) {
      this.displayError(telNode, Message.VAL_TEL_EMPTY);
      return 1;
    } else if (this.checklPattern(2, telNode.value)) {
      this.displayError(telNode, Message.VAL_TEL_NO_CORRECT);
      return 1;
    } else {
      this.removeError(telNode);
      return 0;
    }
  };

  //仕事のバリデーション
  validateWork(workNode) {
    if(this.checkEmpty(workNode.value)) {
      this.displayError(workNode, Message.VAL_WORK_NOT_SELECT);
      return 1;
    } else {
      this.removeError(workNode);
      return 0;
    }
  }

  //クイズ結果の期間指定のバリデーション
  validateDate(fromyear, frommonth, fromday, toyear, tomonth, today) {
    const endDate = document.getElementById('endDate');
    if (
      this.checkEmpty(fromyear.value) ||
      this.checkEmpty(frommonth.value) ||
      this.checkEmpty(fromday.value) ||
      this.checkEmpty(toyear.value) ||
      this.checkEmpty(tomonth.value) ||
      this.checkEmpty(today.value)
    ) {
      this.displayError(endDate, Message.VAL_DATE_EMPTY);
      return 1;
    } else {
      this.removeError(endDate);
      return 0;
    }
  }

  //エラーメッセージを要素内容に持つ要素Nodeを作成して追加
  displayError(node, message) {
    this.removeError(node);
    const errorMessage = document.createElement('span');
    errorMessage.classList.add('error');
    errorMessage.textContent = message;
    node.after(errorMessage);
  };

  //既存のエラーメッセージがある場合は削除
  removeError(node) {
    if (
      node.nextElementSibling != null 
      &&
      node.nextElementSibling.nodeName === 'SPAN'
    ) {
      node.nextElementSibling.remove();
    }
  };

}