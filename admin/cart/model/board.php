<?php

$numberOrder = getCountRows("SELECT id FROM order_pro $filter");

$totalPage = ceil($numberOrder/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allOrder = getRaw("SELECT * FROM order_pro $filter ORDER BY id DESC LIMIT $limitS, $limitE");

$allAuthor = getRaw("SELECT * FROM user");

?>