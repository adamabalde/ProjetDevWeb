<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

// Fetch additional user details from 'users' table
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user['id']]);
$loggedInUser = $stmt->fetch();

// Assuming 'nom', 'prenom', 'email', 'telephone', 'password', 'poste', 'idEntreprise' are columns in your 'users' table
$username = $loggedInUser['username'];
$role = $loggedInUser['role'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maitre de Stage</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Maitre_stage.css">
</head>
<body>

<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">Maitre de Stage</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="#" id="maitre-stage-link">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Mon Espace personnel</span>
            </a>
        </li>
        <li>
            <a href="#" id="etudiants-link">
                <i class='bx bxs-group' ></i>
                <span class="text">Mes Etudiants</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#">
                <i class='bx bxs-cog' ></i>
                <span class="text">Settings</span>
            </a>
        </li>
        
        <style>
    .logout-button {
        display: inline-block;
        background-color: grey;
        color: white;
        border: none;
        padding: 5px 5px;
        font-size: 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .logout-button:hover {
        background-color: #cc0000;
    }

    .logout-button i {
        margin-right: 10px;
        font-size: 20px;
        vertical-align: middle;
    }

    .logout-button .text {
        vertical-align: middle;
    }
</style>

<form id="logout-form" action="logout.php" method="post">
    <button type="submit" class="logout-button">
        <i class='bx bxs-log-out-circle'></i>
        <span class="text">logout</span>
    </button>
</form>


    </ul>
</section>

<section id="content">
    <nav>
        <i class='bx bx-menu' ></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            <img src="img/people.png">
        </a>
    </nav>

    <main>
        <section id="infos-maitre-stage" style="display: block;">
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Profil</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $role; ?></td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="infos-etudiants" style="display: none;">
            <!-- Contenu des informations des étudiants sera chargé ici -->
        </section>
    </main>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const maitreStageLink = document.getElementById('maitre-stage-link');
        const etudiantsLink = document.getElementById('etudiants-link');
        const maitreStageSection = document.getElementById('infos-maitre-stage');
        const etudiantsSection = document.getElementById('infos-etudiants');

        maitreStageLink.addEventListener('click', function(e) {
            e.preventDefault();
            maitreStageSection.style.display = 'block';
            etudiantsSection.style.display = 'none';
        });

        etudiantsLink.addEventListener('click', function(e) {
            e.preventDefault();
            fetch('etudiant.php')
                .then(response => response.text())
                .then(data => {
                    etudiantsSection.innerHTML = data;
                    etudiantsSection.style.display = 'block';
                    maitreStageSection.style.display = 'none';
                });
        });
    });
</script>

<script src="Maitre_stage.js"></script>
</body>
</html>

