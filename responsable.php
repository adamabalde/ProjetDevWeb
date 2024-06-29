<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "gestion_stage");
// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
}

// Obtenir l'id du responsable connecté
session_start();
$user = $_SESSION['user'];
$idResponsable = $user['id'];

// Requête SQL pour récupérer les demandes et les informations des étudiants et des stages dont le responsable est connecté
$sql = "
    SELECT 
        e.nom AS etudiant_nom,
        e.prenom AS etudiant_prenom,
        s.description AS stage_description
    FROM 
        Demande d
    JOIN 
        Etudiant e ON d.idEtudiant = e.idEtudiant
    JOIN 
        Stage s ON d.idStage = s.idStage
    WHERE 
        s.idResponsable = ?
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $idResponsable);
$stmt->execute();
$result = $stmt->get_result();

// Afficher les données des demandes dans le tableau
if ($result->num_rows > 0) {
    echo '<div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Les Demandes</h3>
                <i class="bx bx-search"></i>
                <i class="bx bx-filter"></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nom de létudiant</th>
                        <th>Prénom de létudiant</th>
                        <th>Description du stage</th>
                    </tr>
                </thead>
                <tbody>';
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['etudiant_nom'] . "</td>";
        echo "<td>" . $row['etudiant_prenom'] . "</td>";
        echo "<td>" . $row['stage_description'] . "</td>";
        echo "</tr>";
    }
    echo '</tbody>
            </table>
        </div>
    </div>';
} else {
    echo "<p>Aucune demande trouvée</p>";
}

// Fermer la connexion à la base de données
$mysqli->close();
?>
