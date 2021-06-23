<?php
$pdo = new PDO('mysql:host=localhost;dbname=crud_db', 'root', '');

//print_r(get_class_methods($pdo));
if($pdo) {
    echo 'Connection Successful';
}