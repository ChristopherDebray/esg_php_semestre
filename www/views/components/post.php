<div class="container--post">
    <?php foreach($dataPost as $post):?>
        <section class="row gx--3 post">
            <div class="col-6 col-12-sm img-container">
                <img src="<?= $post["imgSrc"] ?>" alt="<?= $post["imgAlt"] ?>">
            </div>
            <div class="col-6 col-12-sm text-container">
                <h1><?= $post["title"] ?></h1>
                <p><?= $post["text"] ?></p>
            </div>
        </section>
        <?php endforeach; ?>
</div>