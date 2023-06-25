<?php include 'layout/header.php' ?>

<?php include 'components/post.php' ?>

<?php include 'layout/footer.php' ?>

<?php
  if(isset($form)) {
    $this->modal("form", $form, $formErrors);
  }
?>