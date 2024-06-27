<?php


$numberExam = getCountRows("SELECT e.id FROM exam AS e INNER JOIN exam_type AS t ON e.exam_type_id=t.id INNER JOIN user AS u ON e.author_id=u.id $filter");

$totalPage = ceil($numberExam/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allExam = getRaw("SELECT e.*, t.name AS 't_name', u.fullname AS 'u_name' FROM exam AS e INNER JOIN exam_type AS t ON e.exam_type_id=t.id INNER JOIN user AS u ON e.author_id=u.id $filter ORDER BY e.id DESC LIMIT $limitS, $limitE");

$allAuthor = getRaw("SELECT * FROM user WHERE id_group<>'4'");

$allExamType = getRaw("SELECT * FROM exam_type");

?>