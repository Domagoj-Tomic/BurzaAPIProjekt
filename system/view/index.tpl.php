<?php
foreach ($data as $key => $info) { ?>
        <strong>
                <?= $key . ")" ?>
                <a href="<?= $info["url"] ?>"><?= $info["url"] ?></a>
                <button onclick="copyToClipboard('<?= $info["url"] ?>', this)">Copy to clipboard</button>
        </strong>
        <br>
        Method: <?= $info["method"] ?>
        <br>
        Description: <?= $info["description"] ?>
        <br>
        <?php if (!$info["parameters"] == []) { ?>
                <strong>Parameters:</strong><br>
                <?php foreach ($info["parameters"] as $param => $desc) { ?>
                        <p><?= $param ?>: <?= $desc ?></p>
        <?php }
        } ?>
        <br><br>
<?php } ?>

<br><br>
<div style="text-align: center; position: absolute; height: 0; width: 99%;">Burza API ©2024 Bogdan Grabovac i Domagoj Tomić</div>

<script>
        function copyToClipboard(text, btn) {
                var tempInput = document.createElement("input");
                tempInput.style = "position: absolute; left: -1000px; top: -1000px";
                tempInput.value = text;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);

                // Change the button text and disable it
                var originalText = btn.textContent;
                btn.textContent = "Copied!";
                btn.disabled = true;

                // Change it back after 2 seconds and enable the button
                setTimeout(function() {
                        btn.textContent = originalText;
                        btn.disabled = false;
                }, 2000);
        }
</script>