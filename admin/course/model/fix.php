<?php

$detailCourse = getRow("SELECT * FROM course WHERE id='$id'");

$allCourseType = getRaw("SELECT * FROM course_type");


?>