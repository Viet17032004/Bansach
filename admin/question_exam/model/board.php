<?php

$numberQuestionExam = getCountRows("SELECT q.id FROM question_exam AS q INNER JOIN exam AS e ON q.exam_id=e.id WHERE exam_id='$exam_id' $filter");

$totalPage = ceil($numberQuestionExam/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allQuestionExam = getRaw("SELECT q.* FROM question_exam AS q INNER JOIN exam AS e ON q.exam_id=e.id WHERE exam_id='$exam_id' $filter ORDER BY q.id DESC LIMIT $limitS, $limitE");

$detailExam = getRow("SELECT id FROM exam WHERE id='$exam_id'");

?>  