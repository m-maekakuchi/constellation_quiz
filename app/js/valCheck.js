
document.getElementById('btn').addEventListener('click', e => {
  e.preventDefault();
  const val = new Validation();
  let errorCount = 0;

  //入力必須の名前のバリデーションチェック
  const name = document.getElementById('name');
  if (val.checkEmpty(name.value)) {
    displayError(name, Message.VAL_NAME_EMPTY);
    errorCount++;
  } else {
    removeError(name);
  }
  
  //入力必須のメールアドレスのバリデーションチェック
  const email = document.getElementById('email');
  if (val.checkEmpty(email.value)) {
    displayError(email, Message.VAL_EMAIL_EMPTY);
    errorCount++;
  } else if (val.checklPattern(0, email.value)) {
    displayError(email, Message.VAL_EMAIL_NOT_CORRECT);
    errorCount++;
  } else {
    removeError(email);
  }

  //入力必須のパスワードのバリデーションチェック
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

  //入力任意の電話番号のバリデーションチェック
  const tel = document.getElementById('tel');
  if (!val.checkEmpty(tel.value)) {
    if (val.checklPattern(2, tel.value)) {
      displayError(tel, Message.VAL_TEL_NO_CORRECT);
      errorCount++;
    } else {
      removeError(tel);
    }
  }

  //エラーがなければalertを表示
  console.log(errorCount);
  if (errorCount === 0) {
    if (window.confirm('この内容で登録しますか')) {
      console.log('Okを押した');
      document.myform.submit();
    }
  }


  //エラーメッセージを要素内容に持つ要素Nodeを追加
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

    
});
