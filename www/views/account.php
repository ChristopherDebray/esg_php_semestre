<!DOCTYPE html>
<html>
<head>
    <title>Mon site MVC</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="mon super site en MVC from scratch">
    <link rel="stylesheet" href="../dist/main.css">
</head>
<body>

<?php include 'components/navbar.php' ?>
<div class="container">
    <?php include $this->view; ?>
</div>
</body>
</html>
