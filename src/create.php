<?php

require_once __DIR__ . '/lib/mysqli.php';

function createReview($link, $review)
{
    $sql = <<<EOT
    INSERT INTO reviews(
        title,
        author,
        status,
        score,
        summary
    ) VALUES (
        "{$review['title']}",
        "{$review['author']}",
        "{$review['status']}",
        "{$review['score']}",
        "{$review['summary']}"
    )
    EOT;

    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error:fail to create review');
        error_log('Debugging Error:' . mysqli_error($link));
    }
}

// HTTPメソッドがPOSTだったら
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTされた情報の格納
    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'score' => $_POST['score'],
        'summary' => $_POST['summary']
    ];
    // バリデーションする

    var_dump($_POST);

    // DB接続
    $link = dbConnect();
    // テーブルを作成する
    createReview($link, $review);
    // DB接続の終了
    mysqli_close($link);
}
// ページの遷移
header("Location:index.php");
