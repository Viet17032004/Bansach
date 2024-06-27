<?php

$numberUser = getCountRows("SELECT u.id from user AS u INNER JOIN groups AS g ON u.id_group=g.id WHERE id_group<>'1' AND id_group<>'2' AND id_group<>'7' $filter");

$totalPage = ceil($numberUser / _PAGE);

$limitS = ($page - 1) * _PAGE;
$limitE = _PAGE;

$allGroups = getRaw("SELECT id, name FROM groups WHERE id<>'1' AND id<>'2' AND id<>'7'");

$allUser = getRaw("SELECT u.*, g.name AS 'g_name' from user AS u INNER JOIN groups AS g ON u.id_group=g.id WHERE id_group<>'1' AND id_group<>'2' AND id_group<>'7' $filter LIMIT $limitS, $limitE");


?>