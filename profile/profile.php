<?php
session_start();

include "../pdo_php.php";
include "../class_lib.php";

if (isset($_SESSION['id']) && isset($_SESSION['security'])) {
    $id = $_SESSION['id'];
    $security = $_SESSION['security'];
    
    if ($security === 'admin' || $security === 'staff') {
        $staff = new Staff_User_Profile($id, $security, $pdo);
        $staff->overdue_borrows($pdo);
        $square_top = $staff->get_square_top();
        $square_bottom = $staff->get_square_bottom();
        
        echo '{ "square-top": "' . $square_top . '",' . 
                '"square-bottom": "' . $square_bottom . '"}'; 
    }
    
    if ($security === 'user') {
        $user = new General_User_Profile($id, $security, $pdo);
        $user->borrows($pdo);
        $user->set_recent_books($pdo);
        $square_top = $user->get_square_top();
        $square_bottom = $user->get_square_bottom();
        $column1 = $user->get_column1();
        
        echo '{ "square-top": "' . $square_top . '",' . 
                '"square-bottom": "' . $square_bottom . '",' . 
                '"column-1": "' . $column1 . '"}';
    }
           
}