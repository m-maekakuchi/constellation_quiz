const registBtn = document.getElementById('registBtn');
if (registBtn != null) {
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
    if (val.checkEmpty(pass.value)) {
      displayError(pass, Message.VAL_PASS_EMPTY);
      errorCount++;
    } else if (val.checkEmpty(passConfirm.value)) {
      displayError(passConfirm, Message.VAL_PASS_CONFIRM_EMPTY);
      removeError(pass);
      errorCount++;
    } else if (val.checklPattern(1, pass.value)) {
      displayError(pass, Message.VAL_PASS_NOT_CORRECT);
      removeError(passConfirm);
      errorCount++;
    } else if (pass.value !== passConfirm.value) {
      displayError(passConfirm, Message.VAL_PASS_NOT_EQUAL);
      removeError(pass);
      errorCount++;
    } else {
      removeError(pass);
      removeError(passConfirm);
    }

    //入力任意の電話番号のバリデーション
    const tel = document.getElementById('tel');
    if (!val.checkEmpty(tel.value)) {
      if (val.checklPattern(2, tel.value)) {
        displayError(tel, Message.VAL_TEL_NO_CORRECT);
        errorCount++;
      } else {
        removeError(tel);
      }
    }

    console.log(errorCount);
    //エラーがなければalertを表示
    if (errorCount === 0) {
      if (window.confirm('この内容で登録しますか')) {
        document.registForm.submit();
      }
    }
  });
}

//名前入力欄のバリデーション
function validateName(form, val) {
  if (val.checkEmpty(form.value)) {
    displayError(form, Message.VAL_NAME_EMPTY);
    return 1;
  } else {
    removeError(form);
    return 0;
  }
};

//メールアドレス入力欄のバリデーション
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
}



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

const loginBtn = document.getElementById('loginBtn');
if (loginBtn != null) {
  loginBtn.addEventListener('click', e =>{
    e.preventDefault();
    const val = new Validation();
    let errorCount = 0;
  
    //Emailのバリデーション
    const email = document.getElementById('email');
    if (validateEmail(email, val) === 1) {
      errorCount++;
    }
  });
}
