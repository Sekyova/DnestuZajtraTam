<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  unset($_SESSION['uzivatel']);
        $value = $_COOKIE['uzivatel'];
        setcookie("uzivatel", $value, 1);
        header("Refresh:0");

?>
<html>
    <head>
<meta http-equiv="refresh" content="0; url=index.php" />
    </head>
</html>