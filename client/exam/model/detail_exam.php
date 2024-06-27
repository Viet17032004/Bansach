<?php

$detailExam = getRow("SELECT * FROM exam WHERE id='$id'");

$numberQuestionExam = getCountRows("SELECT id FROM question_exam WHERE exam_id='$id'");

if(!empty($user_id)){
    $makeExam = getRow("SELECT id FROM make_exam WHERE exam_id='$id' AND user_id='$user_id'");
}

?>