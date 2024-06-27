<?php

$numberUser = getCountRows("SELECT u.id from user AS u INNER JOIN groups AS g ON u.id_group=g.id WHERE id_group='3' $filter");

$totalPage = ceil($numberUser / _PAGE);

$limitS = ($page - 1) * _PAGE;
$limitE = _PAGE;

$allUser = getRaw("SELECT u.*, g.name AS 'g_name' from user AS u INNER JOIN groups AS g ON u.id_group=g.id WHERE id_group ='3' $filter LIMIT $limitS, $limitE");


?>