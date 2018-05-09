<?php

include "../pdo_php.php";
include "../class_lib.php";

if (isset($_SESSION['id']) && isset($_SESSION['security'])) {
    $id = $_SESSION['id'];
    $security = $_SESSION['security'];

    $user = new User_Profile($id, $security, $pdo);
    $details = $user->get_details_html();

    echo '{ "details": "' . $details . '"}';
}
