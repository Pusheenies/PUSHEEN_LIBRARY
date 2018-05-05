<?php
session_start();

include "../pdo_php.php";
include "../class_lib.php";

if (isset($_SESSION['id']) && isset($_SESSION['security'])) {
    $id = $_SESSION['id'];
    $security = $_SESSION['security'];
    
    if ($security === 'admin' || $security === 'staff') {
        $staff = new Staff_User_Profile($id, $security, $pdo);
        $square_top = $staff->get_square_top();
        
        echo '{ "square-top": "' . $square_top . '"}';  
    }
    
    if ($security === 'user') {
        $user = new General_User_Profile($id, $security, $pdo);
        $user->borrows($pdo);
        $borrows = $user->get_borrows_data();
        $square_top = $user->get_square_top();
        $square_bottom = $user->get_square_bottom($borrows);
        
        echo '{ "square-top": "' . $square_top . '",' . 
                '"square-bottom": "' . $square_bottom . '"}';
    }
           
}