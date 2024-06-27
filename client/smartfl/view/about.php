<?php

$htmlAbout = getRow("SELECT * FROM options WHERE opt_key LIKE '%web_about%'")['opt_value'];

?>

<div class="container_my padding_X py-3">
 <?php

echo html_entity_decode($htmlAbout);

?>   
</div>