<?php include 'layout/header.php' ?>

<?php include 'components/slideshow.php' ?>
<?php include 'components/customcard.php' ?>
<?php include 'components/quote.php' ?>

<?php // include 'components/post.php' ?>

<?php include 'layout/footer.php' ?>


<section class="row">
  <?php foreach ($comments as $comment):?>
    <div class="col-3"></div>
    <div class="row col-6 pt-3">
      <div class="col-12 row justfify-between">
        <span>
          <?php
            echo $comment->getUser()->getFirstname() . " " . $comment->getUser()->getLastname();
          ?>
        </span>
        <span>
          <?php
            $timestamp = strtotime($comment->getDateInserted());
            $formattedDate = date('Y-m-d H:i:s', $timestamp);
            
            echo $formattedDate;
          ?>
        </span>
      </div>
      <div class="col-12 font--md pt-5">
        <?= $comment->getContent() ?>
      </div>
    </div>
    <div class="col-3"></div>
  <?php endforeach;?>
  <?php
    if(isset($form)) {
      $this->modal("form", $form, $formErrors);
    }
  ?>
</section>