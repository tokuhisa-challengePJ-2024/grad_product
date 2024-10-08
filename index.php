<?php
session_start();
// funcs.php読み込み
include("funcs.php");

// セッションにユーザーIDが設定されているか確認
if (!isset($_SESSION['user_id'])) {
    $loggedIn = false;
} else {
    $loggedIn = true;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ツーリングSNS & ナビ</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../grad_product/css/style.css">
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <h1>ツーリングSNS & ナビ</h1>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2a9d90;">
            <div class="container">
                <div class="navbar-brand text-white">ホーム</div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="#">ツーリングを探す</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="/../grad_product/post_touring.php">ツーリングを投稿する</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="/../grad_product/mypage.php">マイページ</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php
                        session_start();
                        if (isset($_SESSION['user_name'])) {
                            // ログインしている場合
                            echo '<li class="nav-item">';
                            echo '<span class="nav-link text-white">ようこそ, ' . htmlspecialchars($_SESSION['user_name']) . 'さん</span>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link btn btn-warning text-dark" href="logout.php">ログアウト</a>'; // ボタンスタイル
                            echo '</li>';
                        } else {
                            // ログインしていない場合
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link btn btn-warning text-dark" href="login.html">ログイン</a>'; // login.htmlに遷移
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <h2 class="my-4">最新の投稿</h2>
        
        <!-- タイムラインカード -->
        <div class="timeline-card">
            <h4>投稿タイトル</h4>
            <p>ここに投稿内容を表示、ツーリングルートや感想など。</p>
            <button class="btn btn-custom">ツーリングルートを見る</button>
            <button class="btn btn-custom">いいね</button>
        </div>
        
        <div class="timeline-card">
            <h4>別の投稿タイトル</h4>
            <p>ここに別の投稿内容を表示</p>
            <button class="btn btn-custom">ツーリングルートを見る</button>
            <button class="btn btn-custom">いいね</button>
        </div>

        <!-- 他の投稿が続く -->
    </div>

    <!-- フッター -->
    <footer>
        <p>&copy; 2024 ツーリングSNS & ナビ</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
