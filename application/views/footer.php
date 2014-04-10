
        <br>
        <br>    
        <p align="right">Última actualización <?= date("d/m/Y", strtotime($fecha)); ?>
        <p align="right"><?= $instancia ?> - <?= $nombre ?></p> 
        </div> 
        <script>
            $(".mostr").click(function() {
                var id = $(this).parent().attr("id").substring(7);
                if ($(this).text() === 'Detalle') {
                    $("#juez" + id).show();
                    $("#rival" + id).show();
                    $("#elFaro" + id).show();
                    $(this).text('Ocultar');
                }
                else {
                    $("#juez" + id).hide();
                    $("#rival" + id).hide();
                    $("#elFaro" + id).hide();
                    $(this).text('Detalle');
                }
            });
        </script>
    </body>
</html>
