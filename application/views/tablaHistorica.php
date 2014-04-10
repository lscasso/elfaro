<table class="table table-striped table-hover  table-bordered table-condensed">
    <thead>
        <tr>
            <th colspan="2"></th>
            <th colspan="4">Partidos</th>
            <th colspan="2">Goles</th>
            <th colspan="2">Penales</th>            
        </tr>
        <tr>
            <th colspan="2">Rival</th>
            <th>Jugados</th>
            <th>Ganados</th>
            <th>Empatados</th>
            <th>Perdidos</th>
            <th>Favor</th>
            <th>En contra</th>
            <th>Ganados</th>
            <th>Perdidos</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $ganados = 0;
        $perdidos = 0;
        $empatados = 0;
        $golesC = 0;
        $golesF = 0;
        $gPenales = 0;
        $pPenales = 0;
        foreach ($rivales as $rival){
        ?>
        <tr>
            <td style="text-align: left" colspan="2"><a href='<?= base_url(); ?>index.php/estadisticas/rival/<?=$rival['id'];?>'><?=$rival['nombre']?></a></td>
            <td><?=$rival['ganados']+$rival['perdidos']+$rival['empatados']?></td>
            <td><?=$rival['ganados']?></td>
            <td><?=$rival['empatados']?></td>
            <td><?=$rival['perdidos']?></td>
            <td><?=$rival['golesF']?></td>
            <td><?=$rival['golesC']?></td>
            <td><?=$rival['gPenales']?></td>
            <td><?=$rival['pPenales']?></td>
        </tr>
        <?php 
            $ganados += $rival['ganados'];
            $empatados += $rival['empatados'];
            $perdidos += $rival['perdidos'];
            $golesF += $rival['golesF'];
            $golesC += $rival['golesC'];
            $gPenales += $rival['gPenales'];
            $pPenales += $rival['pPenales'];
        } 
        ?>
        </tbody>
        <tfoot>
        <tr>
        <td style="text-align: left" colspan="2">Totales:</td>
        <td><?=$ganados+$perdidos+$empatados?></td>
        <td><?=$ganados?></td>
        <td><?=$empatados?></td>
        <td><?=$perdidos?></td>
        <td><?=$golesF?></td>
        <td><?=$golesC?></td>
        <td><?=$gPenales?></td>
        <td><?=$pPenales?></td>
        </tr>
        </tfoot>
</table>  