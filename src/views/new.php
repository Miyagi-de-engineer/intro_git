<h2 class="h3 text-dark mb-4">読書ログの登録</h2>
<form action="create.php" method="post">
    <?php if (count($errors)) : ?>
        <ul class="text-danger">
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="form-group">
        <label for="title">書籍名</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php echo $review['title']; ?>">
    </div>
    <div class="form-group">
        <label for="author">著者名</label>
        <input type="text" name="author" class="form-control" id="author" value="<?php echo $review['author']; ?>">
    </div>
    <div>
        <label>読書状況</label>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input type="radio" name="status" class="form-check-input" id="status1" value="未読" checked <?php echo ($review['status'] === '未読') ? 'checked' : ''; ?>>
                <label for="status1" class="form-check-label">未読</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="status" class="form-check-input" id="status2" value="読んでる" <?php echo ($review['status'] === '読んでる') ? 'checked' : ''; ?>>
                <label for="status2" class="form-check-label">読んでる</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="status" class="form-check-input" id="status3" value="読了" <?php echo ($review['status'] === '読了') ? 'checked' : ''; ?>>
                <label for="status3" class="form-check-label">読了</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="score">評価（5点満点の整数）</label>
        <input type="number" name="score" class="form-control" id="score" value="<?php echo $review['score']; ?>">
    </div>
    <div class="form-group">
        <label for="summary">感想</label>
        <textarea type="text" name="summary" class="form-control" id="summary" rows="10"><?php echo $review['summary']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">登録する</button>
</form>
