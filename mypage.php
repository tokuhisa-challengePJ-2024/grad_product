<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ - ツーリングSNS & ナビ</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../grad_product/css/style.css">
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <h1>ツーリングSNS & ナビ</h1>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2a9d90;">
            <div class="container">
                <div class="navbar-brand text-white">マイページ</div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="index.php">ホーム</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="#">ツーリングを探す</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="#">ツーリングを投稿する</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php
                        session_start();
                        if (isset($_SESSION['user_name'])) {
                            echo '<li class="nav-item">';
                            echo '<span class="nav-link text-white">ようこそ, ' . htmlspecialchars($_SESSION['user_name']) . 'さん</span>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link btn btn-warning text-dark" href="logout.php">ログアウト</a>';
                            echo '</li>';
                        } else {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link btn btn-warning text-dark" href="login.html">ログイン</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- メインコンテンツ -->
    <div class="container">
        <h2 class="my-4">マイページ</h2>

        <!-- プロフィール情報 -->
        <div class="profile-info">
            <h3><?php echo htmlspecialchars($user_name); ?></h3>
            <p>フォロワー: <?php echo $follower_count; ?> | フォロー中: <?php echo $following_count; ?></p>
        </div>

        <!-- タイムラインカード -->
        <?php foreach ($user_posts as $post): ?>
            <div class="timeline-card">
                <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                <p><?php echo htmlspecialchars($post['content']); ?></p>
                <button class="btn btn-custom">ツーリングルートを見る</button>
                <button class="btn btn-custom">いいね</button>
            </div>
        <?php endforeach; ?>
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
