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
        <?php if (!$info["parameters"] == []) { ?>
                <strong>Parameters:</strong><br>
        <?php foreach($info["parameters"] as $param => $desc){?>
              <p><?=$param?>: <?=$desc?></p>  
        <?php }} ?>
        <br><br>
<?php } ?>

<br><br><div style="text-align: center; position: absolute; height: 0; width: 99%;">Burza API ©2024 Bogdan Grabovac i Domagoj Tomić</div>