<?php

include "../pdo_php.php";
include "../class_lib.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
            
    $login = new Login($username, $password);
    $login->check_credentials($pdo);
}