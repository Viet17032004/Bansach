<?php

$detailMakeExam = getRow("SELECT * FROM make_exam WHERE id='$make_exam'");

if(!empty($detailMakeExam)){
    $exam_id = $detailMakeExam['exam_id'];
    $allQuestionExam = getRaw("SELECT * FROM question_exam WHERE exam_id='$exam_id'");
    $detailExam = getRow("SELECT e.*, t.name AS 't_name' FROM exam AS e INNER JOIN exam_type AS t ON e.exam_type_id=t.id WHERE e.id='$exam_id'");

    $user_id = _MY_DATA['id'];
    $allResultExam = getRaw("SELECT id FROM result_exam WHERE user_id='$user_id' ORDER BY id DESC");

}



?>