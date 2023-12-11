<?php 
session_start();
unset($_SESSION["e_mali"]);
unset($_SESSION["senha"]);
unset($_SESSION["confirmasenha"]);
session_destroy();
header("Location: ./login.html");
exit;
?>