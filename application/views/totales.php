<h3>Totales</h3>
<table class="table table-striped table-hover  table-bordered table-condensed">
    <thead>
        <tr>
            <th colspan="4">Partidos</th>
            <th colspan="2">Goles</th>
            <th colspan="2">Penales</th>            
        </tr>
        <tr>
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
        <tr>
            <td><?=$ganados+$perdidos+$empatados?></td>
            <td><?=$ganados?></td>
            <td><?=$empatados?></td>
            <td><?=$perdidos?></td>
            <td><?=$golesF?></td>
            <td><?=$golesC?></td>
            <td><?=$gPenales?></td>
            <td><?=$pPenales?></td>
        </tr>
    <tbody>
</table>  