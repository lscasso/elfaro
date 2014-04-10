<h3>Tabla de Goleadores</h3>
<table class="table table-striped table-hover  table-bordered table-condensed">
    <thead>
        <tr>
            <th>Jugador</th>
            <th>Goles</th>
            <th>Jugada</th>
            <th>Penal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($goleadores as $goleador){
            
        ?>
        <tr>
            <td style="text-align: left"><a  href="<?=base_url()?>index.php/estadisticas/jugadores/<?=$goleador['id']?>" ><?=$goleador['nombre']?></a></td>
            <td><strong><?=$goleador['jugada'] + $goleador['penales']?><strong></td>
            <td><?=$goleador['jugada']?></td>
            <td><?=$goleador['penales']?></td>
            
        </tr>
        <?php
        }
        ?>
    <tbody>
</table>  