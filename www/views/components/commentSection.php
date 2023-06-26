<?php if (isset($comments)): ?>
<section class="row pb-5">
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
        <a class="button --danger" href='signal-comment?id=<?=$comment->getId()?>&page=<?= $comment->getPage()->getSlug()?>' >Signaler</a>
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
<?php endif; ?>