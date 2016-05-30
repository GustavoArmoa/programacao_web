<html lang="pt-Br">
<head>
    <!--Import materialize.css-->
    <link rel="stylesheet" href="./bower_components/Materialize/dist/css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="./css/material-icon/material-icons.css">
    <link rel="stylesheet" href="./css/app.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
    <title>UNDB</title>
</head>

<body class="grey lighten-4" ng-app="crud" ng-cloak>

<header>
    <div class="navbar-fixed">
        <nav class="light-blue lighten-1">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">Lista de Filmes</a>
            </div>
        </nav>
    </div>
</header>

<main class="container white z-depth-1">
    <?= $this->getContent(); ?>
</main>

<footer class="page-footer transparent">
    <div class="footer-copyright transparent">
        <div class="container blue-text text-lighten-1 center">
            © 2016 Jhordan Lima
        </div>
    </div>
</footer>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="./bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="./bower_components/Materialize/dist/js/materialize.min.js"></script>
<script type="text/javascript" src="./bower_components/angular/angular.min.js"></script>
<script type="text/javascript" src="./bower_components/barbara-js/barbarajs.js"></script>
<script type="text/javascript" src="./bower_components/angular-modal-service/dst/angular-modal-service.min.js"></script>
<script type="text/javascript" src="./bower_components/angular-materialize/src/angular-materialize.js"></script>
<script type="text/javascript" src="./js/app/crud_undb/app.js"></script>
<script type="text/javascript" src="./js/app/crud_undb/service/filmes.js"></script>
<script type="text/javascript" src="./js/app/crud_undb/controller/filmes.js"></script>

</body>
</html>