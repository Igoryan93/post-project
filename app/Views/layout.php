<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->e($title)?></title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <?= $this->insert('modules/styles') ?>
</head>
<body class="mod-bg-1 mod-nav-link">

<?= $this->insert('modules/header') ?>

<main id="js-page-content" role="main" class="page-content mt-3">

<?= $this->section('content') ?>

</main>

<?= $this->insert('modules/footer') ?>

</body>
<?= $this->insert('modules/scripts') ?>
</html>