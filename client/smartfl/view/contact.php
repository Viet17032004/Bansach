<?php

$htmlContact = getRow("SELECT * FROM options WHERE opt_key LIKE '%web_contact%'")['opt_value'];

?>

<div class="container_my padding_X py-3 row mx-0">

<div class="col-6">

<?php

echo html_entity_decode($htmlContact);

?>

</div>

<div class="col-6 home_contact">

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59595.67671264159!2d105.7394401403703!3d21.003465733707706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad0fb0b56971%3A0xdb103aab2ba17d34!2zTmjDoCBTw6FjaCBQaMawxqFuZyBOYW0!5e0!3m2!1svi!2s!4v1701408873385!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div>

</div>