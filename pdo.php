<?php
$pdo= new PDO("mysql:host=localhost;dbname=Pusheen_library", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);