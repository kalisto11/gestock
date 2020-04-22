<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Team UVS">
        <base href="/gestock/public/">
        <title>Gestion de stock</title>
        <link rel="shortcut icon" type="image/png" href="images/icones/favicon.png">
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fichier css  -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/menu.css">
    </head>
    <body>
        <!-- BARRE DU LOGO ET ZONE DE RECHERCHE -->
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0" id="logo" href="#">TEAM UVS KAFFRINE</a>
                <input class="form-control form-control-dark w-50" type="text" placeholder="Recherche" aria-label="Search">
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap ">
                    <a class="nav-link" href="#">Connexion</a>
                </li>
            </ul>
        </nav>
        <!-- FIN BARRE DU LOGO ET ZONE DE RECHERCHE -->

        <div class="container-fluid">
            <div class="row">
                <!-- PANNEAU TITRE ET MENU LATERAL -->
                <div class="nav-side-menu">
                <div class="brand">LOGO</div>
                <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                <div class="menu-list">
                    <ul id="menu-content" class="menu-content collapse out">
                        <li>
                            <a href="#">
                            <i class="fa fa-dashboard fa-lg"></i>
                            Tableau de bord
                            </a>
                        </li>
                        <li  data-toggle="collapse" data-target="#personnel" class="collapsed bg-info">
                            <img src="images/icones/personnel.jpg"class="mr-2 ml-2 menu-icone">Personnel<span class="arrow"></span>
                        </li>
                        <ul class="sub-menu collapse" id="personnel">
                            <li><a href="/gestock/personnels/liste"><img src="images/icones/personnel.png" class="mr-2 ml-2 bg-white menu-icone">Agents</a></li>
                            <li><a href="/gestock/postes/liste"><img src="images/icones/poste.jpg" class="mr-2 ml-2 bg-white menu-icone">Postes</a></li>
                        </ul>
                        <li data-toggle="collapse" data-target="#bons" class="collapsed bg-info">
                            <img src="images/icones/bon.png"class="mr-2 ml-2 bg-white menu-icone"></i>Bons<span class="arrow"></span>
                        </li>  
                        <ul class="sub-menu collapse" id="bons">
                            <li><a href="/gestock/articles/liste"><img src="images/icones/article.png" class="bg-white mr-2 menu-icone">Nom des Articles</a></li>
                            <li><a href="/gestock/bonsentree/liste"><img src="images/icones/entree.JPG" class="mr-2 menu-icone">Bon d'entrée</a></li>
                            <li><a href="/gestock/bonssortie/liste"><img src="images/icones/sortie.JPG" class="mr-2 menu-icone">Bon de sortie</a></li>
                        </ul>
                        <li data-toggle="collapse" data-target="#journal" class="collapsed bg-info">
                            <img src="images/icones/dossier.png" class="mr-2 ml-2 bg-white menu-icone">Journal<span class="arrow"></span>
                        </li>
                        <ul class="sub-menu collapse" id="journal">
                            <li><a href=""><img src="images/icones/livre journal.JPG" class="mr-2 menu-icone">Livre Journal</a></li>
                            <li><a href=""><img src="images/icones/grand livre.JPG" class="mr-2 menu-icone">Grand Livre</a></li>
                        </ul>
                    </ul>
                </div>
                </div>
            </div>
                <!-- FIN PANNEAU TITRE ET MENU LATERAL -->

                <!-- ZONE D'AFFICHAGE DU CONTENU -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pt-3 pb-2 mb-3 border-bottom bg-dark">
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
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>