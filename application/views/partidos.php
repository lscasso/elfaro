<h3><?=$titulo?></h3>
    <?php
    
    foreach ($partidos as $partido){
        
        ?>
    <h5><?=$partido['instancia']?></h5>
    <div class="row partido">
        <div class="col-xs-2">
            <?=  date("d/m/Y H:i",strtotime($partido['fecha']))  ?>
        </div>
        <div class="col-xs-6">
            <div class="col-xs-5">
                <p align="right"><strong>El Faro</strong></p> 
                <div id="elFaro<?=$partido['id']?>" style="display: none;">
                <?php foreach ($incidencias[$partido['id']] as $incidencia){
                        incidencia($incidencia['nombre'],  $incidencia['tipo'], true,$incidencia['id']);
                }
                ?>
                </div> 
            </div>
            <div class="col-xs-2">
                <p align="center">
                    <strong>
                        <?=$partido['golesFaro']?>:<?=$partido['golesRival']?>
                        <?php if (isset($partido['penalesFaro']) && isset($partido['penalesRival'])){
                            echo '('.$partido['penalesFaro'].':'.$partido['penalesRival'].')';
                        }
                        ?>
                    </strong></p>
            </div>
            <div class="col-xs-5">
                <p><strong><a href="<?= base_url(); ?>index.php/estadisticas/rival/<?=$partido['rival'];?>"><?=$partido['nombre']?></a></strong></p> 
                <div id="rival<?=$partido['id']?>" style="display: none;"> 
                <?php foreach ($incidencias[$partido['id']] as $incidencia){
                        incidencia($incidencia['nombre'],  $incidencia['tipo'], false);
                }
                ?>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <?php
            if (isset($partido['cancha'])){
                ?>
                <p><?=$partido['cancha'];?></p>    
                <?php
            }
            ?>
            <div id="juez<?=$partido['id']?>" style="display: none;" >
                <p>
                    <?php
                    if (isset($partido['juez'])){
                        ?>
                        <p>Arbitro: <?=$partido['juez'];?></p>    
                        <?php
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="col-xs-2">
            <p align="right" id="mostrar<?=$partido['id']?>">
            [<a href="#" class="mostr" id="mostr" align="right" >Detalle</a>]
            </p>
            
        </div>
    </div>
        <?php
    }
    ?>


            
