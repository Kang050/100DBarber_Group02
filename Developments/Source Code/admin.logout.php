<?php

session_start();
include_once './DBConnect.php';
unset($_SESSION["Admin"]);
session_destroy();
header("location:admin.index.php");
exit();

