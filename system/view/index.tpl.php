Burza API ©2024 Bogdan Grabovac i Domagoj Tomić<br><br>

<?php
foreach($data as $key => $info) { ?>
        <strong>
                <?=$key . ")"?>
                <a href="<?=$info["url"]?>"><?=$info["url"]?></a>
        </strong>
        <br>
        Method: <?=$info["method"]?>
        <br>
        Description: <?=$info["description"]?>
        <br>
        <strong>Parameters:</strong><br>
        <?php foreach($info["parameters"] as $param => $desc){?>
              <p><?=$param?>: <?=$desc?></p>  
        <?php } ?>
        <br>
<?php } ?>