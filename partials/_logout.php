<?php
session_start();
$_SESSION['loggedin'] = false;
header("location: index.php");

?>