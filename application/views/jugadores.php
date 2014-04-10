<div class="row">
    <div class="col-xs-2"><img src="<?= base_url(); ?>/assets/jugadores/<?=$id?>.jpg" onError="this.src='<?= base_url(); ?>/assets/jugadores/noImage.png'"></div>
    <div class="col-xs-2">
        <p>Apodo:</p>
        <p>Fecha Nacimiento:</p>
        <p>Goles:</p>
        <p>Amarillas:</p>
        <p>Rojas:</p>
    </div>
    <div class="col-xs-8">
        <p><br></p>
        <p><br></p>
        <p><?=$goles?></p>
        <p><?=$amarillas?></p>
        <p><?=$rojas?></p>
    </div>
</div>