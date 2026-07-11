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
    
    $sql = "SELECT * FROM " . TABLE_UTENTI . " WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    
    if ($row) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $errore = "Username o password errati!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Mood Space</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body class="login-body">
    <h1>✨ Mood Space</h1>
    <h2>Login</h2>
    <?php if (isset($errore)) echo "<p class='errore'>$errore</p>"; ?>
    <form action="login.php" method="post">
        <p>Username: <input type="text" name="username" /></p>
        <p>Password: <input type="password" name="password" /></p>
        <p><input type="submit" name="invio" value="Accedi" /></p>
        <p><a href="register.php">Non hai un account? Registrati</a></p>
    </form>
</body>
</html>