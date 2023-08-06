<?php

session_start();
include_once './DBConnect.php';
unset($_SESSION["sesAdmin"]);
session_destroy();
header("location:index.php");
exit();

