<?php

// 今後はSQLを用いたDB操作の内容も入ってくるよ

function createReview()
{
    echo '読書ログを登録してください' . PHP_EOL;
    echo '書籍名：';
    $title = trim(fgets(STDIN));

    echo '著者名：';
    $author = trim(fgets(STDIN));

    echo '読書状況（未読，読んでる，読了）：';
    $status = trim(fgets(STDIN));

    echo '評価（５点満点の整数）：';
    $score = trim(fgets(STDIN));

    echo '感想：';
    $summary = trim(fgets(STDIN));

    echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    return [
        'title' => $title,
        'author' => $author,
        'status' => $status,
        'score' => $score,
        'summary' => $summary,
    ];
}

function listReview($reviews)
{
    echo '読書ログを表示します' . PHP_EOL;
    foreach ($reviews as $review) {
        echo '書籍名：' . $review['title'] . PHP_EOL;
        echo '著者名' . $review['author'] . PHP_EOL;
        echo '読書状況：' . $review['status'] . PHP_EOL;
        echo '評価：' . $review['score'] . PHP_EOL;
        echo '感想：' . $review['summary'] . PHP_EOL;
        echo '--------------------------' . PHP_EOL;
    }
}

$reviews = [];

while (true) {

    echo '1.読書ログを登録' . PHP_EOL;
    echo '2.読書ログを表示' . PHP_EOL;
    echo '9.アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）：';

    $num = trim(fgets(STDIN));

    if ($num === '1') {
        // 読書ログを登録する
        $reviews[] = createReview();
    } else if ($num === '2') {
        // 読書ログを表示
        listReview($reviews);
    } else if ($num === '9') {
        // アプリケーションを終了する
        break;
    }
}

// echo '書籍名：銀河鉄道の夜' . PHP_EOL;
// echo '著者名：宮沢賢治' . PHP_EOL;
// echo '読書状況：読了' . PHP_EOL;
// echo '評価：５' . PHP_EOL;
// echo '感想：本当の幸せとはなんだろうかと考えさせられる作品だった。' . PHP_EOL;
