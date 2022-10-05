//アカウント登録画面の「登録」ボタンが押された場合
const registBtn = document.getElementById('registBtn');
if (registBtn !== null) {
  registBtn.addEventListener('click', e => {
    e.preventDefault();
    const val = new Validation();
    let errorCount = 0;

    //入力必須の名前のバリデーション
    const name = document.getElementById('name');
    if (validateName(name, val) === 1) {
      errorCount++;
    }
    
    //入力必須のメールアドレスのバリデーション
    const email = document.getElementById('email');
    if (validateEmail(email, val) === 1) {
      errorCount++;
    }
    
    //入力必須のパスワードのバリデーション
    const pass = document.getElementById('pass');
    const passConfirm = document.getElementById('passConfirm');
    if (validateRegistPass(pass, passConfirm, val) === 1){
      errorCount++;
    }

    //入力任意の電話番号のバリデーション
    const tel = document.getElementById('tel');
    if (!val.checkEmpty(tel.value)) {
      if (validateTel(tel, val)) {
        errorCount++;
      }
    }

    //エラーがなければalertを表示
    //「OK」ボタンが押されたらaction先にパラメータを送信
    if (errorCount === 0) {
      if (window.confirm('この内容で登録しますか')) {
        document.registForm.submit();
      }
    }
  });
}

//ログイン画面の「ログイン」ボタンが押された場合
const loginBtn = document.getElementById('loginBtn');
if (loginBtn !== null) {
  loginBtn.addEventListener('click', e => {
    e.preventDefault();
    const val = new Validation();
    let errorCount = 0;
  
    //メールアドレスのバリデーション
    const email = document.getElementById('email');
    if (validateEmail(email, val) === 1) {
      errorCount++;
    }

    //パスワードのバリデーション
    const pass = document.getElementById('pass');
    if(validateLoginPass(pass, val) === 1) {
      errorCount++;
    }

    //エラーがなければパラメータをaction先に送信
    if (errorCount === 0) {
      document.loginForm.submit();
    }
  });
}

//マイページの名前の更新ボタンが押された場合
const updateNameBtn = document.getElementById('updateNameBtn');
if (updateNameBtn !== null) {
  updateNameBtn.addEventListener('click', e => {
    e.preventDefault();
    const val = new Validation();
    const name = document.getElementById('name');
    if (validateName(name, val) === 0) {
      document.updateNameForm.submit();
    }
  });
}

//マイページのメールアドレスの更新ボタンが押された場合
const updateEmailBtn = document.getElementById('updateEmailBtn');
if (updateEmailBtn !== null) {
  updateEmailBtn.addEventListener('click', e => {
    e.preventDefault();
    const val = new Validation();
    const email = document.getElementById('email');
    if (validateEmail(email, val) === 0) {
      document.updateEmailForm.submit();
    }
  });
}

//名前のバリデーション
function validateName(form, val) {
  if (val.checkEmpty(form.value)) {
    displayError(form, Message.VAL_NAME_EMPTY);
    return 1;
  } else {
    removeError(form);
    return 0;
  }
};

//メールアドレスのバリデーション
function validateEmail(form, val) {
  if (val.checkEmpty(form.value)) {
    displayError(form, Message.VAL_EMAIL_EMPTY);
    return 1;
  } else if (val.checklPattern(0, form.value)) {
    displayError(form, Message.VAL_EMAIL_NOT_CORRECT);
    return 1;
  } else {
    removeError(form);
    return 0;
  }
};

//ログイン時のパスワードのバリデーション
function validateLoginPass(pass, val) {
  if (val.checkEmpty(pass.value)) {
    displayError(pass, Message.VAL_PASS_EMPTY);
    return 1;
  } else {
    removeError(pass);
    return 0;
  }
}

//パスワード登録のバリデーション
function validateRegistPass(pass, passConfirm, val) {
  if (val.checkEmpty(pass.value)) {
    displayError(pass, Message.VAL_PASS_EMPTY);
    return 1;
  } else if (val.checkEmpty(passConfirm.value)) {
    displayError(passConfirm, Message.VAL_PASS_CONFIRM_EMPTY);
    removeError(pass);
    return 1;
  } else if (val.checklPattern(1, pass.value)) {
    displayError(pass, Message.VAL_PASS_NOT_CORRECT);
    removeError(passConfirm);
    return 1;
  } else if (pass.value !== passConfirm.value) {
    displayError(passConfirm, Message.VAL_PASS_NOT_EQUAL);
    removeError(pass);
    return 1;
  } else {
    removeError(pass);
    removeError(passConfirm);
    return 0;
  }
};

//電話番号のバリデーション
function validateTel(tel, val) {
  if (val.checklPattern(2, tel.value)) {
    displayError(tel, Message.VAL_TEL_NO_CORRECT);
    return 1;
  } else {
    removeError(tel);
    return 0;
  }
};

//エラーメッセージを要素内容に持つ要素Nodeを作成して追加
function displayError(form, message) {
  removeError(form);
  const errorMessage = document.createElement('span');
  errorMessage.classList.add('error');
  errorMessage.textContent = message;
  form.after(errorMessage);
};

//既存のエラーメッセージがある場合は削除
function removeError(form) {
  if (
    form.nextElementSibling != null 
    &&
    form.nextElementSibling.nodeName === 'SPAN'
  ) {
    form.nextElementSibling.remove();
  }
};
