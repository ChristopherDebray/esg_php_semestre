<?php include 'layout/header.php' ?>

<?php include 'components/video.php' ?>
<?php include 'components/article.php' ?>
<?php include 'components/wysiwyg.php' ?>

<?php include 'layout/footer.php' ?>

<?php
  if(isset($form)) {
    $this->modal("form", $form, $formErrors);
  }
?>