<?php

$allBookType = getRaw("SELECT * FROM book_type");

$arrSlide = json_decode(getRow("SELECT * FROM options WHERE opt_key='web_slide'")['opt_value'], true);
?>

