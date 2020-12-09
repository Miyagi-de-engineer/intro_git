<a href="new.php">読書ログを登録する</a>
<main>
    <?php if (count($reviews) > 0) : ?>
        <?php foreach ($reviews as $review) : ?>
            <section>
                <div>
                    <h2><?php echo escape($review['title']); ?></h2>
                    <div>
                        <?php echo escape($review['author']); ?>&nbsp;/&nbsp;
                        <?php echo escape($review['status']); ?>&nbsp;/&nbsp;
                        <?php echo escape($review['score']); ?>点
                    </div>
                    <p>
                        <?php echo nl2br(escape($review['summary']), false); ?>
                    </p>
                </div>
            </section>
        <?php endforeach; ?>
    <?php else : ?>
        <p>登録されている読書ログはありません</p>
    <?php endif; ?>
</main>
