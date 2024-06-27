<?php


$numberBookType = getCountRows("SELECT id FROM book_type $filter");

$totalPage = ceil($numberBookType/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allBookType = getRaw("SELECT * FROM book_type $filter ORDER BY id DESC LIMIT $limitS, $limitE");



?>