<?php

$detailResultExam = getRow("SELECT r.*, u.fullname AS 'u_name' FROM result_exam AS r INNER JOIN user AS u ON r.user_id=u.id WHERE r.id='$result_exam_id'");

?>