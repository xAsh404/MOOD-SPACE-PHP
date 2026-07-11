<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once('connection.php');

$username = $_SESSION['username'];

if (isset($_POST['elimina'])) {
    $id = $_POST['diarioId'];
    $sql = "DELETE FROM " . TABLE_DIARIO . " WHERE diarioId = '$id' AND username = '$username'";
    mysqli_query($connection, $sql);
}

$sql = "SELECT * FROM " . TABLE_DIARIO . " WHERE username = '$username' ORDER BY data DESC";
$result = mysqli_query($connection, $sql);

$contatore = array('happy'=>0, 'calm'=>0, 'sad'=>0, 'angry'=>0, 'love'=>0, 'anxiety'=>0, 'fear'=>0);
$righe = array();
while ($row = mysqli_fetch_array($result)) {
    $righe[] = $row;
    if (isset($contatore[$row['mood']]))
        $contatore[$row['mood']]++;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Storico - Mood Space</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body class="storico-body">
    <?php include('menu.php'); ?>

    <h1>📅 Il tuo storico mood</h1>

    <h2>Contatore mood</h2>
    <p>🌞 Happy: <?php echo $contatore['happy']; ?> volte</p>
    <p>🌙 Calm: <?php echo $contatore['calm']; ?> volte</p>
    <p>🌧️ Sad: <?php echo $contatore['sad']; ?> volte</p>
    <p>😡 Angry: <?php echo $contatore['angry']; ?> volte</p>
    <p>💕 Love: <?php echo $contatore['love']; ?> volte</p>
    <p>😰 Anxiety: <?php echo $contatore['anxiety']; ?> volte</p>
    <p>😨 Fear: <?php echo $contatore['fear']; ?> volte</p> 

    <h2>I tuoi mood</h2>
    <?php if (count($righe) == 0): ?>
        <p>Non hai ancora scritto nessun mood!</p>
    <?php else: ?>
        <?php foreach ($righe as $row): ?>
            <div class="storico-entry">
                <p><strong><?php echo $row['mood']; ?></strong> — <?php echo $row['data']; ?></p>
                <p><?php echo $row['commento']; ?></p>
                <form action="storico.php" method="post">
                    <input type="hidden" name="diarioId" value="<?php echo $row['diarioId']; ?>" />
                    <input type="submit" name="elimina" value="🗑️ Elimina" />
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>