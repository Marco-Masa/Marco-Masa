<?php $title = "Logout do Sistema de Amigos"; require_once('verificarAcesso.php'); ?>
<?php
    unset($_SESSION['logado']);
    header("location:index.php");
?>