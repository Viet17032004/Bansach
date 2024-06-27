<?php

$numberExamType = getCountRows("SELECT id FROM exam_type $filter");

$totalPage = ceil($numberExamType/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allExamType = getRaw("SELECT * FROM exam_type $filter ORDER BY id DESC LIMIT $limitS, $limitE");

?>