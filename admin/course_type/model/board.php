<?php

$numberCourseType = getCountRows("SELECT id FROM course_type $filter");

$totalPage = ceil($numberCourseType/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allCourseType = getRaw("SELECT * FROM course_type $filter ORDER BY id DESC LIMIT $limitS, $limitE");

?>