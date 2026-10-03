<?php
session_start();
$_SESSION['loggedin'] = false;
header("location: /Forum/index.php");

?>