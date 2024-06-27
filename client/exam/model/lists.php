<?php

$allExamType = getRaw("SELECT * FROM exam_type");

$allExam = getRaw("SELECT e.*, t.name AS 't_name' FROM exam AS e INNER JOIN exam_type AS t ON e.exam_type_id=t.id WHERE `status`<>'0' $filter ORDER BY create_at DESC");

?>