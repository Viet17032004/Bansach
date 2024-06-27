<?php

$numberCourse = getCountRows("SELECT c.id FROM course AS c INNER JOIN course_type AS t ON c.course_type_id=t.id INNER JOIN user AS u ON c.author_id=u.id $filter");

$totalPage = ceil($numberCourse/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allCourse = getRaw("SELECT c.*, t.name AS 't_name', u.fullname AS 'u_name' FROM course AS c INNER JOIN course_type AS t ON c.course_type_id=t.id INNER JOIN user AS u ON c.author_id=u.id $filter ORDER BY id DESC LIMIT $limitS, $limitE");

$allAuthor = getRaw("SELECT * FROM user WHERE id_group<>'4'");

$allCourseType = getRaw("SELECT * FROM course_type");

?>