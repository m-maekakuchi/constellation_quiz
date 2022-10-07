const val = new Validation();

//アカウント登録画面の「登録」ボタンが押された場合
const registBtn = document.getElementById('registBtn');
if (registBtn !== null) {
  registBtn.addEventListener('click', e => {
    e.preventDefault();
    let errorCount = 0;

    //入力必須の名前のバリデーション
    const name = document.getElementById('name');
    if (val.validateName(name) === 1) {
      errorCount++;
    }
    
    //入力必須のメールアドレスのバリデーション
    const email = document.getElementById('email');
    if (val.validateEmail(email) === 1) {
      errorCount++;
    }
    
    //入力必須のパスワードのバリデーション
    const pass = document.getElementById('pass');
    const passConfirm = document.getElementById('passConfirm');
    if (val.validateRegistPass(pass, passConfirm) === 1){
      errorCount++;
    }

    //入力任意の電話番号のバリデーション
    const tel = document.getElementById('tel');
    if (!val.checkEmpty(tel.value)) {
      if (val.validateTel(tel)) {
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
    let errorCount = 0;
  
    //メールアドレスのバリデーション
    const email = document.getElementById('email');
    if (val.validateEmail(email) === 1) {
      errorCount++;
    }

    //パスワードのバリデーション
    const pass = document.getElementById('pass');
    if(val.validateLoginPass(pass) === 1) {
      errorCount++;
    }

    //エラーがなければパラメータをaction先に送信
    if (errorCount === 0) {
      document.loginForm.submit();
    }
  });
}

//マイページのcsvDLボタンかpdfDLボタンが押された場合
const csvDlBtn = document.getElementById('csvDlBtn');
const pdfDlBtn = document.getElementById('pdfDlBtn');
if (pdfDlBtn !== null || pdfDlBtn !== null) {
  const fromyear = document.getElementById('fromyear');
  const frommonth = document.getElementById('frommonth');
  const fromday = document.getElementById('fromday');
  const toyear = document.getElementById('toyear');
  const tomonth = document.getElementById('tomonth');
  const today = document.getElementById('today');

  let newValue = document.createElement('input');
  newValue.type = "hidden";
  newValue.name = "resultDl";

  csvDlBtn.addEventListener('click', e => {
    e.preventDefault();
    if (val.validateDate(fromyear, frommonth, fromday, toyear, tomonth, today) === 0) {
      newValue.value = "csv";
      document.quizResultForm.appendChild(newValue);
      document.quizResultForm.submit();
    }
  });
  pdfDlBtn.addEventListener('click', e => {
    e.preventDefault();
    if (val.validateDate(fromyear, frommonth, fromday, toyear, tomonth, today) === 0) {
      newValue.value = "pdf";
      document.quizResultForm.appendChild(newValue);
      document.quizResultForm.submit();
    }
  });
}

//マイページの名前の更新ボタンが押された場合
const updateNameBtn = document.getElementById('updateNameBtn');
if (updateNameBtn !== null) {
  updateNameBtn.addEventListener('click', e => {
    e.preventDefault();
    const name = document.getElementById('name');
    if (val.validateName(name) === 0) {
      document.updateNameForm.submit();
    }
  });
}

//マイページのメールアドレスの更新ボタンが押された場合
const updateEmailBtn = document.getElementById('updateEmailBtn');
if (updateEmailBtn !== null) {
  updateEmailBtn.addEventListener('click', e => {
    e.preventDefault();
    const email = document.getElementById('email');
    if (val.validateEmail(email) === 0) {
      document.updateEmailForm.submit();
    }
  });
}

//マイページのパスワードの更新ボタンが押された場合
const updatePassBtn = document.getElementById('updatePassBtn');
if (updatePassBtn !== null) {
  updatePassBtn.addEventListener('click', e => {
    e.preventDefault();
    const pass = document.getElementById('pass');
    const passConfirm = document.getElementById('passConfirm');
    if (val.validateRegistPass(pass, passConfirm) === 0) {
      document.updatePassForm.submit();
    }
  });
}

//マイページの住所の更新ボタンが押された場合
const updateAddressBtn = document.getElementById('updateAddressBtn');
if (updateAddressBtn !== null) {
  updateAddressBtn.addEventListener('click', e => {
    e.preventDefault();
    const address = document.getElementById('address');
    if (val.validateAddress(address) === 0) {
      document.updateAddressForm.submit();
    }
  });
}

//マイページの生年月日の更新ボタンが押された場合
const updateBirthdayBtn = document.getElementById('updateBirthdayBtn');
if (updateBirthdayBtn !== null) {
  updateBirthdayBtn.addEventListener('click', e => {
    e.preventDefault();
    const year = document.getElementById('year');
    const month = document.getElementById('month');
    const day = document.getElementById('day');
    if (val.validateBirthday(year, month, day) === 0) {
      document.updateBirthdayForm.submit();
    }
  });
}

//マイページの電話番号の更新ボタンが押された場合
const updateTelBtn = document.getElementById('updateTelBtn');
if (updateTelBtn !== null) {
  updateTelBtn.addEventListener('click', e => {
    e.preventDefault();
    const tel = document.getElementById('tel');
    if (val.validateTel(tel) === 0) {
      document.updateTelForm.submit();
    }
  });
}

//マイページの仕事の更新ボタンが押された場合
const updateWorkBtn = document.getElementById('updateWorkBtn');
if (updateWorkBtn !== null) {
  updateWorkBtn.addEventListener('click', e => {
    e.preventDefault();
    const work = document.getElementById('work');
    if (val.validateWork(work) === 0) {
      document.updateWorkForm.submit();
    }
  });
}