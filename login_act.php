<?php
// 1. session開始
session_start();
$errorMessage = ""; // エラーメッセージの初期化

// 2. funcs.php読み込み
include("funcs.php");
ini_set("display_errors", 1);

// 3. POST値
$email = $_POST["email"]; // email
$password = $_POST["password"]; // password

// 4. DB接続 
$pdo = db_conn();

// 5. SQL作成・実行
$stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email"); 
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$status = $stmt->execute();

// 6. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

// 7. 抽出データ数を取得
$val = $stmt->fetch();     

$password = password_verify($password, hash: $val["password"]); //$password = password_hash($password, PASSWORD_DEFAULT);   //パスワードハッシュ化

// 8. 該当１レコードがあればSESSIONに値を代入
if($password) { 
    //Login成功時
    $_SESSION["chk_ssid"] = session_id(); // SESSION_ID取得して代入
    $_SESSION["user_name"] = $val['user_name']; 
    //Login成功時（index.phpへ）
    redirect("index.php");
  
  }else {
    //Login失敗時(login.phpへ)
    redirect("login.php");
  
  }
  
  exit();

?>