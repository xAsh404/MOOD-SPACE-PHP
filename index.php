<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>✨ Mood Space</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body class="index-body">
    <?php include('menu.php'); ?>
    
    <h1>✨ Mood Space</h1>
    <p>Come ti senti oggi, <?php echo $_SESSION['username']; ?>?</p>

    <div class="moods-container">
    <a href="diario.php?mood=happy" class="mood-card">🌞 Happy</a>
    <a href="diario.php?mood=calm" class="mood-card">🌙 Calm</a>
    <a href="diario.php?mood=sad" class="mood-card">🌧️ Sad</a>
    <a href="diario.php?mood=angry" class="mood-card">😡 Angry</a>
    <a href="diario.php?mood=love" class="mood-card">💕 Love</a>
    <a href="diario.php?mood=anxiety" class="mood-card">😰 Anxiety</a>
    <a href="diario.php?mood=fear" class="mood-card">😨 Fear</a>
</div>
</body>
</html>