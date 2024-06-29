<?php
session_start();

// Vérification des données POST
if (!isset($_POST['username'], $_POST['password'], $_POST['role'])) {
    echo "Veuillez remplir tous les champs du formulaire.";
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Informations de connexion à la base de données
$servername = "localhost"; // Remplacez par votre serveur
$dbname = "gestion_stage"; // Remplacez par le nom de votre base de données
$dbusername = "root"; // Remplacez par votre nom d'utilisateur MySQL
$dbpassword = ""; // Remplacez par votre mot de passe MySQL

// Connexion à la base de données
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Sélection de la table et du champ de mot de passe en fonction du role
$table = '';
$passwordField = '';
if ($role == 'responsable') {
    $table = 'ResponsableDeStage';
    $passwordField = 'passwd';
} elseif ($role == 'maitre') {
    $table = 'MaitreDeStage';
    $passwordField = 'password';
} elseif ($role == 'etudiant') {
    $table = 'Etudiant';
    $passwordField = 'password';
} else {
    // Gestion des erreurs pour un role non valide
    header('Location: Pageconnexion.php?error=invalid_role');
    exit();
}

// Préparation et exécution de la requête SQL
$sql = "SELECT * FROM $table WHERE email = ? AND $passwordField = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Erreur de préparation de la requête: " . $conn->error);
}
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Vérification des résultats
if ($result->num_rows > 0) {
    // Authentification réussie
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['user_id'] = $user['idMaitreStage']; // Par exemple pour maitre de stage

    // Redirection en fonction du role
    if ($role == 'responsable') {
        header('Location: Res_Stage.php');
    } elseif ($role == 'maitre') {
        header('Location: index.php');
    } elseif ($role == 'etudiant') {
        header('Location: page_accueil_etudiant.php');
    }
    exit();
} else {
    // Authentification échouée
    header('Location: Pageconnexion.php?error=invalid_credentials');
    exit();
}

// Fermeture de la connexion
$conn->close();
?>