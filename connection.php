<?php
require_once('dati_generali.php');

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
    echo "Errore di connessione al database: " . mysqli_connect_error();
    exit();
}
?>