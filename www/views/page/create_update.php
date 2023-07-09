<?php
  $previewUrl = 'wireframe';
  if(isset($_GET['wireframe'])) {
    $previewUrl .= $_GET['wireframe'];
  } elseif ($pageTheme) {
    $previewUrl .= $pageTheme;
  }
?>

<div class="container">
  <div class="row">
    <div class="col-3"></div>
    <a class="button button--success" href="<?= $previewUrl ?>" alt="prévisualisation de la page crééer modifiée">preview</a>
  </div>
</div>
<?php $this->modal("form", $form, $formErrors);?>