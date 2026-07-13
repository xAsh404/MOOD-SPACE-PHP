MOOD SPACE - PHP MySQL Project

DESCRIZIONE DEL PROGETTO:

Mood Space PHP é un sito web dinamico che accompagna l'utente in un viaggio
attraverso le emozioni. Il sito mantiene una identità visiva coerente con
sfondi animati e atmosfera spaziale, combinando estetica ed emozione.

L'utente si registra, fa login, sceglie il proprio mood del giorno tra sette emozioni,
scrive un commento personale e può vedere lo storico dei mood salvati con contatore.
Le pagine usano sfondi GIF animati per creare un'atmosfera coerente con il tema emotivo del sito.

PAGINE:

- login.php é la pagina di accesso. L'utente inserisce username e password.
  Se le credenziali sono corrette viene reindirizzato alla home tramite sessione.

- register.php permette la registrazione di un nuovo utente.
  La password viene salvata nel database criptata con md5.
  Dopo la registrazione l'utente viene automaticamente loggato.

- index.php é la Home Page del sito, accessibile solo dopo il login.
  Mostra le sette emozioni disponibili come card disposte con Flexbox.
  Ogni card porta alla pagina diario con il mood preselezionato.

- diario.php é la pagina per scrivere il mood del giorno.
  L'utente sceglie l'emozione dal menu a tendina e scrive un commento.
  Sotto il form appare una frase motivazionale diversa per ogni mood.
  Lo sfondo cambia con il GIF stelle per creare atmosfera.

- storico.php mostra tutti i mood salvati dall'utente in ordine cronologico.
  Include un contatore per ogni mood e il pulsante per eliminare le voci.

- menu.php é il file di navigazione comune incluso in tutte le pagine.
  Mostra i link alle sezioni principali e il nome dell'utente loggato.

- logout.php distrugge la sessione e reindirizza al login.

- install.php crea automaticamente il database e le tabelle necessarie.
  Va eseguito una sola volta prima di usare il sito.

- connection.php gestisce la connessione al database includendo dati_generali.php.

- dati_generali.php contiene tutti i parametri di configurazione del database.
  E l'unico file da modificare per installare il sito su un altro server.


TECNOLOGIE UTILIZZATE:

- PHP per la logica server-side
- MySQL per il salvataggio dei dati
- CSS per grafica e layout
- Flexbox per il layout delle card nella home
- GIF animate per gli sfondi delle pagine


TECNICHE APPROFONDITE:

- Variabili di sessione $_SESSION -> usate per mantenere l'utente loggato tra le pagine.
  Ogni pagina protetta controlla isset($_SESSION['username']) e reindirizza al login se assente.

- $_POST -> usato per ricevere i dati dai form di login, registrazione e diario.
  I dati arrivano al server solo quando l'utente clicca il pulsante di invio.

- md5() -> la password viene criptata prima di essere salvata nel database.
  Cosi anche se qualcuno accede al db non vede le password in chiaro.

- mysqli e prepared statements -> per salvare i commenti nel diario si usano i prepared statements
  con bind_param() per evitare errori SQL quando il commento contiene apostrofi o caratteri speciali.

- dati_generali.php + connection.php -> separazione dei parametri di connessione dalla logica.
  connection.php include dati_generali.php, cosi basta modificare un solo file per cambiare server.

- install.php -> crea il database e le tabelle automaticamente con CREATE DATABASE IF NOT EXISTS
  e CREATE TABLE IF NOT EXISTS, quindi puo essere eseguito piu volte senza errori.

- Classi body per pagina -> ogni pagina ha una classe CSS propria sul body
  (login-body, index-body, diario-body ecc.) per applicare sfondi GIF diversi senza conflitti.

- Flexbox nella home -> le card dei mood usano display:flex, flex-wrap e gap
  per disporsi automaticamente in griglia senza media query.

- Glassmorphism -> le card e i form usano sfondo rgba semitrasparente e backdrop-filter blur(6px)
  per l'effetto vetro smerigliato.

- menu.php con include() -> il menu di navigazione e scritto una sola volta
  e incluso in tutte le pagine con include('menu.php'), evitando ripetizioni.


DIFFICOLTA INCONTRATE:

- Errori SQL con apostrofi nei commenti: quando l'utente scriveva un commento con apostrofi
  la query INSERT andava in errore. Risolto usando i prepared statements con bind_param()
  invece della query diretta con la stringa concatenata.

- Doppia chiamata a session_start(): includendo menu.php nelle pagine che gia avevano
  session_start() generava un warning. Risolto togliendo session_start() da menu.php
  e lasciandolo solo nel file principale.

- Pagina bianca senza messaggi di errore: durante lo sviluppo le pagine PHP 
  mostravano solo una pagina bianca senza spiegazioni. Risolto aggiungendo 
  ini_set('display_errors', 1) e error_reporting(E_ALL) in cima ad ogni file 
  per rendere visibili gli errori durante lo sviluppo.

CREDENZIALI DI ACCESSO:
- username: Test / password: test

INSTALLAZIONE:
1. Copiare la cartella in htdocs di XAMPP
2. Avviare Apache e MySQL da XAMPP Control Panel
3. Aprire: localhost/Kaur.Ashmeet.PHP_MySQL/install.php
4. Aprire: localhost/Kaur.Ashmeet.PHP_MySQL/login.php

AUTORE:
- Ashmeet Kaur

REPOSITORY GITHUB:
- https://github.com/xAsh404/mood-space-php