<?php
// 1. session開始
session_start();

// 2. funcs.php読み込み
include("funcs.php");
ini_set("display_errors", 1);

// 3. POSTデータ取得
$user_name = $_POST["user_name"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_confirm = $_POST["password_confirm"];

// 4. 入力チェック
if (empty($user_name) || empty($email) || empty($password) || empty($password_confirm)) {
    exit("全てのフィールドを埋めてください。");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("メールアドレスが無効です。");
}

if ($password !== $password_confirm) {
    exit("パスワードが一致しません。");
}

// 5. パスワードをハッシュ化
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// 6. DB接続 
$pdo = db_conn();

// 7. データ登録SQL作成
$sql = "INSERT INTO users(user_name, email, password, create_date)VALUES (:user_name, :email, :password, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
$status = $stmt->execute(); // 実行

// 8. データ登録処理後
if ($status == false) {
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
} else {
    // 登録したユーザーIDを取得
    $user_id = $pdo->lastInsertId();
    
    // セッションにユーザー情報を保存
    $_SESSION['user_id'] = $user_id;
    
    // index.phpへリダイレクト
    header("Location: index.php");
    exit();
}
?>