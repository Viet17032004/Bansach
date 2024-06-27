<?php

$allCart = getRaw("SELECT * FROM cart WHERE user_id='$user_id'");

$detailUser = getRow("SELECT * FROM user WHERE id='$user_id'");


?>