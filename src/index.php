<?php

require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/mysqli.php';

function listReview($link)
{
    $reviews = [];
    $sql = 'SELECT id,title,author,status,score,summary FROM reviews';
    $results = mysqli_query($link, $sql);

    while ($review = mysqli_fetch_assoc($results)) {
        $reviews[] = $review;
    }

    mysqli_free_result($results);

    return $reviews;
}

$link = dbConnect();
$reviews = listReview($link);

$title = '読書ログの一覧';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
