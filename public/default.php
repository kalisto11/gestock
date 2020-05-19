
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
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0">
            <a  class="navbar-brand col-sm-3 col-md-2 mx-4" id="logo"><img src="images/icones/education.png" class="mr-2 icone fa-spin">IA KAFFRINE</a>
            <h1 class="h2">GESTION DE STOCK</h1>

            <form class="form-inline mr-4" action="/gestock/recherche">
                <input class="form-control form-control-dark w-10" type="text" placeholder="Recherche" aria-label="Search">
                <button  type="submit" class="btn bg-info my-2 my-sm-0 "><img src="images/icones/recherche.png" class="bouton"></button>
            </form>
        </nav> 
        <!-- FIN BARRE DU LOGO ET ZONE DE RECHERCHE -->

        <!-- DEBUT CONTENEUR MENU LATERAL ET ZONE PRINCIPAL -->
        <div class="container-fluid mt-5">
            <div class="row mt-5">
                <!-- PANNEAU TITRE ET MENU LATERAL -->
                <div class="nav-side-menu mt-4 col-3">
                
                    <div class="d-flex flex-row justify-content-center bd-highlight mt-5 mb-2">
                        <div class="col-3 d-flex align-items-center">
                            <img src="images/icones/utilisateur.png" class="sous-menu" title="Utilisateur connecté">
                        </div>
                        <div class="col-9 text-center">
                            <?= $_SESSION['user']['prenom'] ?> <?= $_SESSION['user']['nom'] ?><br><a href="/gestock/auths/">Se déconnecter</a>
                        </div>
                    </div>
                    <div class="menu-list">
                        <ul id="menu-content" class="menu-content collapse out">
                            <li class="collapsed bg-info">
                                <a href="/gestock/home/"><img src="images/icones/accueil.JPG"class="mr-2 ml-2 bg-white menu-icone">Accueil</a>
                            </li> 
                            <li  data-toggle="collapse" data-target="#personnel" class="collapsed bg-info">
                                <img src="images/icones/personnel.jpg"class="mr-2 ml-2 menu-icone">Personnel
                            </li>
                            <ul class="sub-menu" id="personnel">
                                <li><a href="/gestock/personnels/liste"><img src="images/icones/personnel.png" class="mr-2 ml-2 bg-white menu-icone">Agents</a></li>
                                <li><a href="/gestock/postes/liste"><img src="images/icones/poste.jpg" class="mr-2 ml-2 bg-white menu-icone">Postes</a></li>
                            </ul>
                            <li data-toggle="collapse" data-target="#bons" class="collapsed bg-info">
                                <img src="images/icones/bon.png"class="mr-2 ml-2 bg-white menu-icone">Bons
                            </li>  
                            <ul class="sub-menu" id="bons">
                                <li>
                                    <a href="/gestock/fournisseurs/liste"><img src="images/icones/fournisseur.png" class="bg-white mr-2 ml-2 menu-icone">Fournisseurs</a>
                                </li>
                                <li>
                                    <a href="/gestock/articles/liste"><img src="images/icones/article.png" class="bg-white mr-2 ml-2 menu-icone">Articles</a>
                                </li>
                                <li>
                                    <a href="/gestock/bonsentree/liste"><img src="images/icones/entree.JPG" class="mr-2 ml-2 menu-icone">Bon d'entrée</a>
                                </li>
                                <li>
                                    <a href="/gestock/bonssortie/liste"><img src="images/icones/sortie.JPG" class="mr-2 ml-2 menu-icone">Bon de sortie</a>
                                </li>
                            </ul>
                            <li data-toggle="collapse" data-target="#journal" class="collapsed bg-info">
                                <img src="images/icones/dossier.png" class="mr-2 ml-2 bg-white menu-icone">Journal
                            </li>
                            <ul class="sub-menu" id="journal">
                                <li><a href="/gestock/livrejournals/liste"><img src="images/icones/livre journal.JPG" class="mr-2 menu-icone">Livre Journal</a></li>
                                <li><a href="/gestock/grandlivres/liste"><img src="images/icones/grand livre.JPG" class="mr-2 menu-icone">Grand Livre</a></li>
                            </ul>
                        </ul>
                    </div>
                </div>
                <!-- FIN PANNEAU TITRE ET MENU LATERAL -->

                <!-- ZONE D'AFFICHAGE DU CONTENU -->
                <main role="main" class="col-md-10 ml-sm-auto col-lg-10 mt-5">
                    <div class="mt-5 px-4">
                    <?= $content ?> 
                    </div>
                </main>
                <footer class="m-0 p-0 bg-dark">
                    <p class="text-light m-0">
                        &copy; Copyright IA Kaffrine 2020 - Design by TEAM STAGIAIRES UVS/MAI
                    </p>
                </footer> 
            </div>
        </div>
        <!-- FIN ZONE D'AFFICHAGE DU CONTENU -->
        
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/propper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/notification.js"></script>
        
    </body>
</html>