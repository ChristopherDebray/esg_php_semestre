<section class="row video">
    <section class="col-12">
        <h1><?= $dataVideo["videoTitle"] ?></h1>
        <iframe 
            width="100%"
            height="315"
            src="<?= $dataVideo["videoSrc"] ?>"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        >
        </iframe>
    </section>
</section>