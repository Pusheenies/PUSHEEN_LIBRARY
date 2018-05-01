<?php

include "../class_lib.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
            
    $login = new Login($username, $password);
    $login->db_connect();
    $login->check_credentials();
}