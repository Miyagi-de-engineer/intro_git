<?php

function validate($review)
{
    $errors = [];

    // 書籍名が正しく入力されているかチェック
    if (!strlen($review['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (strlen($review['title'] > 255)) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    // 著者名のバリデーションチェック
    if (!strlen($review['author'])) {
        $errors['author'] = '著者名を入力してください';
    } elseif (strlen($review['author'] > 100)) {
        $errors['author'] = '著者名は100文字以下で入力してください';
    }

    // 読書状況のバリデーションチェック
    static $situation = ['未読', '読んでる', '読了'];
    if (!strlen($review['status'])) {
        $errors['status'] = '読書状況を入力してください';
    } elseif (!in_array($review['status'], $situation)) {
        $errors['status'] = '未読、読んでる、読了のいずれかを入力してください';
    }

    //評価のバリデーションチェック
    if ($review['score'] < 1 || $review['score'] > 5) {
        $errors['score'] = '評価は１から５の整数を入力してください';
    }

    // 感想のバリデーションチェック
    if (!strlen($review['summary'])) {
        $errors['summary'] = '感想を入力してください';
    } elseif (strlen($review['summary'] > 100)) {
        $errors['summary'] = '感想は100文字以下で入力してください';
    }

    return $errors;
}

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

    if (!$link) {
        echo 'Error:データベースに接続できませんでした。' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    // echo 'データベースに接続しました' . PHP_EOL;
    return $link;
}

function createReview($link)
{
    $review = [];
    echo '読書ログを登録してください' . PHP_EOL;
    echo '書籍名：';
    $review['title'] = trim(fgets(STDIN));

    echo '著者名：';
    $review['author'] = trim(fgets(STDIN));

    echo '読書状況（未読，読んでる，読了）：';
    $review['status'] = trim(fgets(STDIN));

    echo '評価（５点満点の整数）：';
    $review['score'] = (int)trim(fgets(STDIN));

    echo '感想：';
    $review['summary'] = trim(fgets(STDIN));

    $validated = validate($review);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        return;
    }

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

    if ($result) {
        echo 'データを追加しました' . PHP_EOL;
    } else {
        echo 'Error:データの追加に失敗しました' . PHP_EOL;
        echo 'DebuggingError:' . mysqli_error($link) . PHP_EOL;
    }
}

function listReview($link)
{
    // SQL文を用いてreviewsテーブルからデータを取得
    $sql = 'SELECT * FROM reviews';
    $results = mysqli_query($link, $sql);

    echo '登録されている読書ログを表示します' . PHP_EOL;

    while ($review = mysqli_fetch_assoc($results)) {
        echo '書籍名：' . $review['title'] . PHP_EOL;
        echo '著者名' . $review['author'] . PHP_EOL;
        echo '読書状況：' . $review['status'] . PHP_EOL;
        echo '評価：' . $review['score'] . PHP_EOL;
        echo '感想：' . $review['summary'] . PHP_EOL;
        echo '--------------------------' . PHP_EOL;
    }
    // メモリの解放
    mysqli_free_result($results);
}

$link = dbConnect();

while (true) {

    echo '1.読書ログを登録' . PHP_EOL;
    echo '2.読書ログを表示' . PHP_EOL;
    echo '9.アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）：';

    $num = trim(fgets(STDIN));

    if ($num === '1') {
        // 読書ログを登録する
        createReview($link);
    } else if ($num === '2') {
        // 読書ログを表示
        listReview($link);
    } else if ($num === '9') {
        // アプリケーションを終了する
        mysqli_close($link);
        break;
    }
}
