<?php
session_start();
require 'config.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

// Récupérer les détails de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT username, role FROM users WHERE id = ?");
$stmt->execute([$user['id']]);
$loggedInUser = $stmt->fetch();

if ($loggedInUser):
?>
<div class="profile-info">
    <table class="profile-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($loggedInUser['username']); ?></td>
                <td><?php echo htmlspecialchars($loggedInUser['role']); ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
endif;
?>
