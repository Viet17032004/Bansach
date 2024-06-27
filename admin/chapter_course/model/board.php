<?php

$numberChapterCourse = getCountRows("SELECT ct.id FROM chapter_course AS ct INNER JOIN course AS c ON ct.course_id=c.id WHERE c.id='$id' $filter");

$totalPage = ceil($numberChapterCourse/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allChapterCourse = getRaw("SELECT ct.* FROM chapter_course AS ct INNER JOIN course AS c ON ct.course_id=c.id WHERE c.id='$id' $filter ORDER BY ct.id DESC LIMIT $limitS, $limitE");

$detailCourse = getRow("SELECT id FROM course WHERE id='$id'");

?>