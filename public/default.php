<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Team UVS">
        <base href="/gestock/">
        <title>Gestion de stock</title>
        <link rel="shortcut icon" type="image/png" href="images/icones/favicon.png">
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Fichier css  -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!-- BARRE DU LOGO ET ZONE DE RECHERCHE -->
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">TEAM UVS KAFFRINE</a>
                <input class="form-control form-control-dark w-100" type="text" placeholder="Recherche" aria-label="Search">
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="#">Connexion</a>
                </li>
            </ul>
        </nav>
        <!-- FIN BARRE DU LOGO ET ZONE DE RECHERCHE -->

        <div class="container-fluid">
            <div class="row">
                <!-- PANNEAU TITRE ET MENU LATERAL -->
                <nav class="col-md-2 d-none d-md-block bg-light sidebar mt-5">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                            PERSONNEL
                                <a class="nav-link" href="/gestock/personnel/listeposte">LISTE DES POSTES</a>
                                <a href="/gestock/personnel/form-ajouterposte">AJOUTER UN POSTE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/gestock/nomarticles/">ARTICLES</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- FIN PANNEAU TITRE ET MENU LATERAL -->

                <!-- ZONE D'AFFICHAGE DU CONTENU -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">GESTION DE STOCK</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Imprimer</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Exporter</button>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                This week
                            </button>
                        </div>
                    </div>
                    <div>
                    <?= $content ?> 
                    </div>
                </main>
                <!-- FIN ZONE D'AFFICHAGE DU CONTENU -->
            </div>
        </div>
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/propper.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
    </body>
</html>
