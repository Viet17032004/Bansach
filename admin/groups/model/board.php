<?php

$numberGroup = getCountRows("SELECT id FROM groups $filter");

$totalPage = ceil($numberGroup/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allGroup = getRaw("SELECT * FROM groups $filter ORDER BY id DESC LIMIT $limitS, $limitE");



?>