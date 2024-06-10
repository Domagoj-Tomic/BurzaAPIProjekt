Burza API ©2024 Bogdan Grabovac i Domagoj Tomić<br><br>

<?php
foreach($data as $key => $info) { ?>
        <strong>
                <?=$key?>
                <?=$info["url"]?>
        </strong>
        <br>
        Metoda: <?=$info["method"]?>
        <br>
        <?=$info["description"]?>
        <br>
<?php } ?>
