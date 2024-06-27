<?php

// echo "SELECT e.* FROM exercise_course AS e INNER JOIN chapter_course AS c ON e.chapter_id = c.id WHERE e.chapter_id='$chapter_id' $filter";

$numberExerciseCourse = getCountRows("SELECT e.id FROM exercise_course AS e INNER JOIN chapter_course AS c ON e.chapter_id = c.id WHERE e.chapter_id='$chapter_id' $filter");

$totalPage = ceil($numberExerciseCourse /_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allExerciseCourse = getRaw("SELECT e.* FROM exercise_course AS e INNER JOIN chapter_course AS c ON e.chapter_id = c.id WHERE e.chapter_id='$chapter_id' $filter ORDER BY e.id DESC LIMIT $limitS, $limitE");



$detailChapter = getRow("SELECT id FROM chapter_course WHERE id='$chapter_id'");

?>