
document.querySelector('form').addEventListener('submit', e => {
  e.preventDefault();
  const val = new Validation();
  let errorCount = 0;

  const name = document.getElementById('name');
  if (val.checkEmpty(name.value)) {
    displayError(name, Message.VAL_NAME_EMPTY);
    errorCount++;
  } else {
    removeError(name);
  }

  // const email = document.getElementById('email');
  // if (val.checkEmpty(email.value)) {
  //   displayError(email, Message.VAL_EMAIL_EMPTY);
  //   errorCount++;
  // } else if (val.checklPattern(0, email.value)) {
  //   displayError(email, Message.VAL_EMAIL_NOT_CORRECT);
  //   errorCount++;
  // } else {
  //   removeError(email);
  // }
  
  // エラーがなければalertを表示
  // console.log(errorCount);
  // if (errorCount === 0) {
  //   if (window.confirm('この内容で登録しますか')) {
  //     console.log('OKが押された');
  //     //次の画面に遷移
  //   } else {
  //     console.log('Cancelが押された');
  //     //特に何もしない
  //   };
  // }


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


