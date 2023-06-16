
<section class="row slideshow">
    <div class="col-12">
        <?php foreach ($dataSlideshow as $element):?>
            <div class="slide">
              <img src="<?= $element["imgSrc"] ?>" alt="<?= $element["imgAlt"]??'' ?>">
            </div>
        <?php endforeach;?>
      <span class="previous_slide" onclick="changeSlide(-1)"><</span>
      <span class="next_slide" onclick="changeSlide(1)">></span>
    </div>
</section>
