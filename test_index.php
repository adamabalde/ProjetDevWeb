<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="Maitre_stage.css">

    <title>AdminHub</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">AdminHub</span>
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
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
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
        <!-- NAVBAR -->

        <!-- MAIN -->
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
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Password</th>
                                    <th>Poste</th>
                                    <th>idEntreprise</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                session_start();

                                // Vérifier si l'utilisateur est connecté
                                if (!isset($_SESSION['user_id'])) {
                                    header('Location: Pageconnexion.php');
                                    exit();
                                }

                                // Connexion à la base de données
                                $mysqli = new mysqli("localhost", "root", "", "gestion_stage");
                                // Vérifier la connexion
                                if ($mysqli->connect_error) {
                                    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
                                }

                                // Récupérer l'ID de l'utilisateur connecté
                                $user_id = $_SESSION['user_id'];

                                // Requête SQL pour récupérer les données de l'utilisateur connecté
                                $sql = "SELECT * FROM maitredestage WHERE idMaitreStage = ?";
                                $stmt = $mysqli->prepare($sql);
                                $stmt->bind_param('i', $user_id);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                // Afficher les données de l'utilisateur dans le tableau
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['idMaitreStage'] . "</td>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['prenom'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['telephone'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                        echo "<td>" . $row['poste'] . "</td>";
                                        echo "<td>" . $row['idEntreprise'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>Aucun maître de stage trouvé</td></tr>";
                                }

                                // Fermer la connexion à la base de données
                                $mysqli->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section id="infos-etudiants" style="display: none;">
                <!-- Contenu des informations des étudiants sera chargé ici -->
            </section>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script >
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