<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'config.php';

$error = '';
$role = isset($_GET['role']) ? $_GET['role'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
    $stmt->execute([$username, $role]);
    $user = $stmt->fetch();

    if ($user && isset($user['passwd'])) {
        if ($passwd === $user['passwd']) {
            $_SESSION['user'] = $user;
            if ($role === 'etudiant') {
                header("Location: Etudiant1.php");
                exit;
            } elseif ($role === 'maitre') {
                header("Location: Maitre_stage.php");
                exit;
            } elseif ($role === 'responsable') {
                header("Location: Res_Stage.php");
                exit;
            }
        } else {
            $error = "Mot de passe incorrect."; 
        }
    } else {
        $error = "Nom d'utilisateur ou rôle incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="container">
        <img src="image/log.png" class="three-image" alt="Logo">
        <h1>Welcome</h1>
        <form action="" method="POST">
            <input type="hidden" name="role" value="<?php echo htmlspecialchars($role); ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="passwd">Mot de passe</label>
                <input type="password" id="passwd" name="passwd" required>
            </div>
            <a href="#">Mot de passe oublié?</a>
            <br>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
