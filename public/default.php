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
                <nav class="col-md-2 d-none d-md-block bg-secondary sidebar mt-5">
                    <div class="sidebar-sticky"> 
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active text-white" href="#">PERSONNEL</a>
                                <a class="nav-link" href="/gestock/personnel/voirliste²">VOIR LA LISTE DU PERSONNEL</a>
                                <a href="/gestock/personnel/ajouterposte">AJOUTER UN POSTE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#"><img src="images\icones\dossier.png"> ARTICLES</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="listnomArticles.php">Voir Liste des Articles</a>
                                <a class="dropdown-item" href="ajoutnomArticle.php">Ajouter un Article</a>
                                </div>
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
         
</body>
    
</html>
