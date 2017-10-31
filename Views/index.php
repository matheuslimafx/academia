<?php
session_start();
var_dump($_SESSION);
if (!$_SESSION['logado']):
    session_destroy();
    header('Location: view.login');
endif;
?>
<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->

