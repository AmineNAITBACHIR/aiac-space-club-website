<?php
//configuration


try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=space_club_website;charset=utf8', 'root', "root");
} catch (Exception $e) {
    die('Error :' . $e->getMessage());
}


?>