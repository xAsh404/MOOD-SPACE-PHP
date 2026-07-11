<nav>
    <?php if (isset($_SESSION['username'])): ?>
        <a href="index.php">✨ Home</a> |
        <a href="diario.php">📝 Scrivi mood</a> |
        <a href="storico.php">📅 Storico</a> |
        <a href="logout.php">🚪 Logout</a>
        <span> — Ciao, <?php echo $_SESSION['username']; ?>!</span>
    <?php else: ?>
        <a href="login.php">Login</a> |
        <a href="register.php">Registrati</a>
    <?php endif; ?>
</nav>