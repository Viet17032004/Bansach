<?php

$detailExam = getRow("SELECT * FROM exam WHERE id='$id'");

$allExamType = getRaw("SELECT * FROM exam_type");

?>