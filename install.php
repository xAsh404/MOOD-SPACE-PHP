<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('dati_generali.php');

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    echo "Errore di connessione: " . mysqli_connect_error();
    exit();
}

/*Crea il database*/ 

$sql = "CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "`";
if ($connection->query($sql))
    echo "Database creato!<br />";
else
    echo "Errore database: " . $connection->error . "<br />";

/*Seleziona il database*/

$connection->select_db(DB_NAME);

/*Crea tabella utenti*/

$sql = "CREATE TABLE IF NOT EXISTS " . TABLE_UTENTI . " (
    userId INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (userId),
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($connection->query($sql))
    echo "Tabella utenti creata!<br />";
else
    echo "Errore tabella utenti: " . $connection->error . "<br />";

/*Crea tabella diario*/

$sql = "CREATE TABLE IF NOT EXISTS " . TABLE_DIARIO . " (
    diarioId INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (diarioId),
    username VARCHAR(50) NOT NULL,
    mood VARCHAR(50) NOT NULL,
    commento TEXT,
    data DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if ($connection->query($sql))
    echo "Tabella diario creata!<br />";
else
    echo "Errore tabella diario: " . $connection->error . "<br />";

$connection->close();
echo "Installazione completata!";
?>