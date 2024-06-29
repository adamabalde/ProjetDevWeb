<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="etudiant.css">
    <title>Gestion de Stage</title>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Profil Etudiant</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#" id="profil-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Mon espace personnel</span>
                </a>
            </li>
            <li>
                <a href="#" id="entreprises-link">
                    <i class='bx bxs-group'></i>
                    <span class="text">Les entreprises</span>
                </a>
            </li>
            <li>
                <a href="#" id="sujets-link">
                    <i class='bx bx-category'></i>
                    <span class="text">Les Sujets</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-message-square'></i>
                    <span class="text">Renseignement infos</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="hover-effect">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Changer mot de passe</span>
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
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
        </nav>

        <div id="main-content">
            <div id="profil" class="content-section">
                <h2>Profil</h2>
                <section class="profile-details">
                    <?php include 'profile.php'; ?>
                </section>
            </div>
            
            <div id="entreprises" class="content-section" style="display: none;">
                <h2>Les entreprises partenaires</h2>
                <table class="entreprises-table">
                    <thead>
                        <tr>
                            <th>nom</th>
                            <th>Description</th>
                            <th>Adresse</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>GSO Sénégal</td>
                            <td>Global Solution et Optimisation (GSO) est une société de droit privé Sénégalais intervenant dans le</td>
                            <td>7, avenue Carde – 3ème Etage</td>
                            <td><button class="btn-postuler" data-url="https://gso-senegal.sn/">postuler</button></td>
                        </tr>
                        <tr>
                            <td>Sonatel Sénégal</td>
                            <td>Le Groupe Sonatel est un opérateur téléphonique du Sénégal qui commercialise des prestations de télécommunications dans les domaines du fixe, du mobile, de l'Internet, de la télévision et des données au service des particuliers et des entreprises.</td>
                            <td>64, Voie de Dégagement Nord ( VDN), BP: 69 Dakar, Dakar 11000</td>
                            <td><button class="btn-postuler" data-url="http://www.sonatel.sn" >postuler</button></td>
                        </tr>
                        <tr>
                            <td>Free Sénégal</td>
                            <td>Free est une entreprise sénégalaise qui propose aux particuliers des offres mobiles et des services financiers comme le transfert d'argent et une carte de paiement prépayée sous la marque Free Money.</td>
                            <td>Sicap Darabis Villa N 4 Bourguiba(en face de casino), Near Rue 10</td>
                            <td><button class="btn-postuler" data-url="http://www.free.sn">postuler</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div id="sujets" class="content-section" style="display: none;">
                <h2>Les Sujets</h2>
                <div class="sujets-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Proposé par</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Application web pour la gestion des stages</td>
                                <td>Mandicou Ba</td>
                                <td><button class="btn-choisir">choisir</button></td>
                            </tr>
                            <tr>
                                <td>Plateforme pour la gestion des demandes de bourse</td>
                                <td>Ibrahima Fall</td>
                                <td><button class="btn-choisir">choisir</button></td>
                            </tr>
                            <tr>
                                <td>Mise en place d'un système de suivi des absences des étudiants basée sur la reconnaissance d'empreintes digitales</td>
                                <td>Fatou NGOM</td>
                                <td><button class="btn-choisir">choisir</button></td>
                            </tr>
                            <tr>
                                <td>Mise en place d'un système de surveillance forestière pour la détection précoce des incendies</td>
                                <td>Mouhamed DIOP</td>
                                <td><button class="btn-choisir">choisir</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="etudiant.js"></script>
</body>
</html>
