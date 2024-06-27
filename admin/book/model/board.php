<?php

$numberBook = getCountRows("SELECT b.id from book AS b INNER JOIN book_type AS t ON b.book_type_id=t.id $filter");

$totalPage = ceil($numberBook/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;


$allBook = getRaw("SELECT b.*, t.name AS 't_name' from book AS b INNER JOIN book_type AS t ON b.book_type_id=t.id $filter ORDER BY create_at DESC LIMIT $limitS, $limitE");

$allBookType = getRaw("SELECT * FROM book_type");

?>