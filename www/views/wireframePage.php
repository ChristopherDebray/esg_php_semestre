<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $config['config-description'] ?>">
    <meta name="keywords" content="<?= $config['config-keywords'] ?>">
    <link rel="stylesheet" href="../dist/main.css">
    <script src="../dist/js/slideshow.js" defer></script>
</head>
<body>
    <div class="container">
        <?php include $this->view; ?>
    </div>
</body>
</html>
