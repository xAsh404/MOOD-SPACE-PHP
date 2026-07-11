<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once('connection.php');

$mood = isset($_GET['mood']) ? $_GET['mood'] : '';

if (isset($_POST['invio'])) {
    $username = $_SESSION['username'];
    $mood = $_POST['mood'];
    $commento = $_POST['commento'];
    
    $stmt = $connection->prepare("INSERT INTO " . TABLE_DIARIO . " (username, mood, commento) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $mood, $commento);
    
    if ($stmt->execute()) {
        $successo = "Mood salvato! ✨";
    } else {
        $errore = "Errore nel salvataggio!";
    }
    $stmt->close();
}

$frasi = array(
    'happy'   => "Continua a sorridere, la felicità è contagiosa! 🌞",
    'calm'    => "La calma è la tua forza. Respira. 🌙",
    'sad'     => "Va bene non stare bene. Passerà. 💙",
    'angry'   => "Respira profondo. Ce la fai. 🌿",
    'love'    => "L'amore è la cosa più bella. Goditi questo momento. 💕",
    'anxiety' => "Respira. Un passo alla volta. Ce la fai. 🌸",
    'fear'    => "Il coraggio non è assenza di paura, è andare avanti nonostante essa. 💪"
);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Diario - Mood Space</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body class="diario-body">
    <?php include('menu.php'); ?>

    <h1>📝 Come ti senti oggi?</h1>

    <?php if (isset($successo)) echo "<p class='successo'>$successo</p>"; ?>
    <?php if (isset($errore)) echo "<p class='errore'>$errore</p>"; ?>

    <form action="diario.php" method="post">
        <p>Mood:
            <select name="mood">
                <option value="happy"   <?php if($mood=='happy')   echo 'selected'; ?>>🌞 Happy</option>
                <option value="calm"    <?php if($mood=='calm')    echo 'selected'; ?>>🌙 Calm</option>
                <option value="sad"     <?php if($mood=='sad')     echo 'selected'; ?>>🌧️ Sad</option>
                <option value="angry"   <?php if($mood=='angry')   echo 'selected'; ?>>😡 Angry</option>
                <option value="love"    <?php if($mood=='love')    echo 'selected'; ?>>💕 Love</option>
                <option value="anxiety" <?php if($mood=='anxiety') echo 'selected'; ?>>😰 Anxiety</option>
                <option value="fear"    <?php if($mood=='fear')    echo 'selected'; ?>>😨 Fear</option>
            </select>
        </p>
        <p>Commento:<br/>
            <textarea name="commento" rows="4" cols="40"></textarea>
        </p>
        <p><input type="submit" name="invio" value="Salva" /></p>
    </form>

    <?php if ($mood && isset($frasi[$mood])): ?>
        <p><em><?php echo $frasi[$mood]; ?></em></p>
    <?php endif; ?>

</body>
</html>