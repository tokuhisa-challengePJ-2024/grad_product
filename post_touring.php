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
    <title>ツーリングを投稿する</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* プレビュー画像のスタイル */
        .preview {
            margin-top: 10px;
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
        }
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
    </style>
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <h1 class="text-center my-4">ツーリングSNS & ナビ</h1>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2a9d90;">
            <div class="container">
                <a class="navbar-brand text-white" href="index.php">ホーム</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="index.php">ツーリングを探す</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="post_touring.php">ツーリングを投稿する</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="mypage.php">マイページ</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <span class="nav-link text-white">ログイン中: <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-dark" href="logout.php">ログアウト</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- メインコンテンツ -->
    <div class="container">
        <h2 class="my-4">ツーリング記録の追加</h2>

        <form action="add_trip_process.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="photos">画像:</label>
                <input type="file" id="photos" name="photos[]" accept="image/*" multiple onchange="previewImages(event)" class="form-control">
                <div class="preview-container" id="preview-container"></div>
            </div>

            <div class="form-group">
                <label for="start_location">出発地:</label>
                <input type="text" id="start_location" name="start_location" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_location">到着地:</label>
                <input type="text" id="end_location" name="end_location" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="distance">距離 (km):</label>
                <input type="text" id="distance" name="distance" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date">日付:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="notes">メモ:</label>
                <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-warning btn-block">投稿</button>
        </form>
    </div>

    <!-- フッター -->
    <footer class="text-center mt-4">
        <p>&copy; 2024 ツーリングSNS & ナビ</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function previewImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // プレビュー画像をクリア

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview');
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    </script>
</body>
</html>
