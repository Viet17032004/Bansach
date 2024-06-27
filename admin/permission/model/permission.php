<?php

$detailGroup = getRow("SELECT * FROM groups WHERE id='$id'");

$allModule = getRaw("SELECT * FROM modules");

?>