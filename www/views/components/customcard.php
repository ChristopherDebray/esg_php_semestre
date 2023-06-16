
<section class="row customcard">
    <?php foreach ($dataCustomcard as $card):?>
        <section class="col-4 col-12-sm">
            <img src="<?= $card["imgSrc"]?>" alt="<?= $card["imgAlt"]?>"/>
            <h1><?= $card["title"]?></h1>
            <p><?= $card["p"]?></p>
        </section>
    <?php endforeach;?>
</section>
