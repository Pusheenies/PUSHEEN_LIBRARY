<?php
<<<<<<< HEAD

include "../pdo_php.php";
include "../class_lib.php";


=======
include "../pdo_php.php";
include "../class_lib.php";
>>>>>>> book_search
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
            
    $user = new User_Login($username, $password);
    $user->login($pdo);
}