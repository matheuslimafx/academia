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
<!-- Wrapper for slides -->
<div class="container">
    <h2>Academia Performance Fit</h2>
</div>