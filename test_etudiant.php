<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="test_etudiant.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Mon espace personnel</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#">Les entreprises</a></li>
                <li><a href="#">Les sujets</a></li>
                <li><a href="#">Renseignement info</a></li>
                <li><a href="#">Changer mot de passe</a></li>
                <li><a href="#">Se déconnecter</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header>
                <h1>Profil</h1>
            </header>
            <section class="profile-details">
                <?php include 'profile.php'; ?>
            </section>
        </main>
    </div>
</body>
</html>
