<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>El Faro</title>        
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/faro.css">
        <script type='text/javascript' src='<?= base_url(); ?>/assets/jquery-1.11.0.min.js'></script>        
        <script type='text/javascript' src='<?= base_url(); ?>/assets/bootstrap/js/bootstrap.min.js'></script>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/bootstrap/css/bootstrap-theme.min.css">
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="<?= base_url(); ?>/assets/bootstrap/js/respond.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" rel="home" href="<?= base_url(); ?>" title="El Faro">
                        <img style="margin-top: -7px;" src="<?= base_url(); ?>/assets/escudo.png"></a>


                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <!-- <li class="active"><a href="#">Link</a></li> -->
                        <li><a href="<?=base_url()?>">Histórico de resultados</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Goleadores <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=base_url()?>index.php/estadisticas/goleadores/">Todos los campeonatos</a></li>
                                <?php foreach ($campeonatos as $campeonato) {
                                    ?>                              
                                <li><a href="<?=base_url()?>index.php/estadisticas/goleadores/<?=$campeonato['id']?>"><?=$campeonato['nombre']?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jugadores <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($jugadores as $jugador) {
                                    ?>                                
                                <li><a href="<?=base_url()?>index.php/estadisticas/jugadores/<?=$jugador['id']?>"><?=$jugador['nombre']?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                         <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Campeonatos <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($campeonatos as $campeonato) {
                                    ?>                              
                                <li><a href="<?=base_url()?>index.php/estadisticas/campeonato/<?=$campeonato['id']?>"><?=$campeonato['nombre']?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Rivales <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($rivales as $rival) {
                                    ?>                              
                                <li><a href="<?=base_url()?>index.php/estadisticas/rival/<?=$rival['id']?>"><?=$rival['nombre']?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <!--
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    -->
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <br><br>
        <div class="container">
            <h1 id="overview" class="page-header"><?= $nombre ?></h1> 