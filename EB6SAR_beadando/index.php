<?php session_start(); ?>
<?php require_once 'protected/config.php'; ?>
<?php require_once USER_MANAGER; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Beadando</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?=PUBLIC_DIR.'style.css?'.date('YmdHis', filemtime(PUBLIC_DIR.'style.css'))?>">
</head>
<body>
    <div class="home">
    <nav><?php require_once PROTECTED_DIR.'nav.php'; ?></nav>
    <content><?php require_once PROTECTED_DIR.'routing.php'; ?></content>
    <footer><?php require_once PROTECTED_DIR.'footer.php'; ?></footer>
    </div>
</body>
</html>