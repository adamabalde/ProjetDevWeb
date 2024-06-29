
<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "gestion_stage");
// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
}
// Requête SQL pour récupérer les données des étudiants
$sql = "SELECT nom, prenom ,email ,telephone ,statut ,niveau   FROM etudiant";
$result = $mysqli->query($sql);
// Afficher les données des étudiants dans le tableau
if ($result->num_rows > 0) {
    echo '<div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Profil</h3>
                <i class="bx bx-search"></i>
                <i class="bx bx-filter"></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Statut</th>
                        <th>Niveau</th>
                    </tr>
                </thead>
                <tbody>';
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['prenom'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telephone'] . "</td>";
        echo "<td>" . $row['statut'] . "</td>";
        echo "<td>" . $row['niveau'] . "</td>";
        echo "</tr>";
    }
    echo '</tbody>
            </table>
        </div>
    </div>';
} else {
    echo "<p>Aucun étudiant trouvé</p>";
}
// Fermer la connexion à la base de données
$mysqli->close();
?>
