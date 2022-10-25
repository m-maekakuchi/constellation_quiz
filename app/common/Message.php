<?php

class Message {
  public static $VAL_NAME_EMPTY            = "名前を入力してください";
  public static $VAL_SAME_EMAIL            = "既に登録されているメールアドレスです";
  public static $VAL_EMAIL_EMPTY           = "メールアドレスを入力してください";
  public static $VAL_EMAIL_NOT_CORRECT     = "メールアドレスが正しく入力されていません";
  public static $VAL_PASS_EMPTY            = "パスワードを入力してください";
  public static $VAL_PASS_CONFIRM_EMPTY    = "パスワード確認用を入力してください";
  public static $VAL_PASS_NOT_CORRECT      = "パスワードは8文字以上16文字以内の半角英数字です";
  public static $VAL_PASS_NOT_EQUAL        = "パスワードが一致していません";
  public static $VAL_TEL_NO_CORRECT        = "電話番号はハイフン(-)を含めて入力してください";
  
  public static $VAL_EMAIL_OR_PASS_EMPTY   = "メールアドレスとパスワードを入力してください";
  public static $VAL_EMAIL_NOT_REGIST      = "メールアドレスが登録されていません";
  public static $VAL_PASSWORD_WRONG        = "パスワードが間違っています";
  
  public static $VAL_TEL_EMPTY             = "電話番号を入力してください";
  public static $VAL_ADDRESS_NOT_SELECT    = "住所を選択してください";
  public static $VAL_BIRTHDAY_NOT_SELECT   = "生年月日を選択してください";
  public static $VAL_WORK_NOT_SELECT       = "仕事を選択してください";
  
  public static $VAL_DATE_EMPTY            = "対象期間を指定してください";
  public static $UPDATE_NAME               = "名前を更新しました";
  public static $UPDATE_EMAIL              = "メールアドレスを更新しました";
  public static $UPDATE_PASS               = "パスワードを更新しました";
  public static $UPDATE_ADDRESS            = "住所を更新しました";
  public static $UPDATE_BIRTHDAY           = "生年月日を更新しました";
  public static $UPDATE_TEL                = "電話番号を更新しました";
  public static $UPDATE_WORK               = "仕事を更新しました";
  
  public static $VAL_QUESTION_EMPTY        = "問題文を入力してください";
  public static $VAL_CHOICE1_EMPTY         = "選択肢1を入力してください";
  public static $VAL_CHOICE2_EMPTY         = "選択肢2を入力してください";
  public static $VAL_CHOICE3_EMPTY         = "選択肢3を入力してください";
  public static $VAL_CHOICE4_EMPTY         = "選択肢4を入力してください";
  public static $VAL_CORRCHOICE_NOT_SELECT = "答えを選択してください";
  public static $INSERT_QUESTION           = "クイズの問題を追加しました";

  public static $NOT_FIND_USERS            = "該当者はいませんでした";
  public static $UPDATE_ADMIN_STATUS       = "さんを管理者として登録しました";
  public static $UPDATE_USER_STATUS        = "さんを管理者から削除しました";
  public static $NOT_UPDATE_STATUS         = "不正な値のため登録できませんでした";
}
