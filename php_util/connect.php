<?php
    $host = 'localhost';      
    $dbname = 'pwa_projekt';     
    $username = 'root';        
    $password = '';           

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Greška pri povezivanju s bazom: ' . $conn->connect_error);
    }
?>
