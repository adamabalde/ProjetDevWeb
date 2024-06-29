<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $passwd = password_hash($_POST['passwd'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, passwd, role) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $passwd, $role])) {
        header("Location: login.php?role=$role");
        exit;
    } else {
        $error = "Erreur lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Inscription</h2>
    <form method="POST" action="">
        <label for="role">role:</label>
        <select name="role">
            <option value="responsable">Responsable de Stage</option>
            <option value="maitre">Maitre de Stage</option>
            <option value="etudiant">Etudiant</option>
        </select>
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" required>
        <label for="passwd">Mot de passe:</label>
        <input type="password" name="passwd" required>
        <button type="submit">S'inscrire</button>
    </form>
    <?php if (!empty($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
