<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['invio'])) {
    require_once('connection.php');
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM " . TABLE_UTENTI . " WHERE username = '$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    
    if ($row) {
        $errore = "Username già esistente!";
    } else {
        $sql = "INSERT INTO " . TABLE_UTENTI . " (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($connection, $sql)) {
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit();
        } else {
            $errore = "Errore durante la registrazione!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrati - Mood Space</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body class="register-body">
    <h1>✨ Mood Space</h1>
    <h2>Registrati</h2>
    <?php if (isset($errore)) echo "<p class='errore'>$errore</p>"; ?>
    <form action="register.php" method="post">
        <p>Username: <input type="text" name="username" /></p>
        <p>Password: <input type="password" name="password" /></p>
        <p><input type="submit" name="invio" value="Registrati" /></p>
        <p><a href="login.php">Hai già un account? Accedi</a></p>
    </form>
</body>
</html>