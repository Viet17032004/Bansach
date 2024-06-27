<?php

$detailBook = getRow("SELECT * FROM book WHERE id='$id'");

$allBookType = getRaw("SELECT * FROM book_type");


?>