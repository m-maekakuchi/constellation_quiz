<?php

class Message {
  //アカウント登録のエラーメッセージ
  public static $NAME_EMPTY          = "名前を入力してください";
  public static $SAME_EMAIL          = "既に登録されているメールアドレスです";
  public static $EMAIL_EMPTY         = "メールアドレスを入力してください";
  public static $EMAIL_NOT_CORRECT   = "メールアドレスが正しく入力されていません";
  public static $PASS_EMPTY          = "パスワードを入力してください";
  public static $PASS_CONFIRM_EMPTY  = "パスワード確認用を入力してください";
  public static $PASS_NOT_CORRECT    = "パスワードは8文字以上16文字以内の半角英数字です";
  public static $PASS_NOT_EQUAL      = "パスワードが一致していません";
  public static $TEL_NO_CORRECT      = "電話番号はハイフン(-)を含めて入力してください";

  //ログインのエラーメッセージ
  public static $EMAIL_OR_PASS_EMPTY = "メールアドレスとパスワードを入力してください";
  public static $EMAIL_NOT_REGIST    = "メールアドレスが登録されていません";
  public static $PASSWORD_WRONG      = "パスワードが間違っています";

  //マイページのエラーメッセージ
  public static $TEL_EMPTY           = "電話番号を入力してください";
  public static $ADDRESS_NOT_SELECT  = "住所を選択してください";
  public static $BIRTHDAY_NOT_SELECT = "生年月日を選択してください";
  public static $WORL_NOT_SELECT     = "仕事を選択してください";

  // public static $QUESTION_NOSELECT   = "全問回答してください";


  
}
