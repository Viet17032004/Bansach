<?php

$allCourse = getRaw("SELECT c.*, t.name AS 't_name', u.fullname AS 'u_name' FROM course AS c INNER JOIN course_type AS t ON c.course_type_id=t.id INNER JOIN user AS u ON c.author_id=u.id WHERE c.status<>'0' $filter ORDER BY create_at DESC");

$allAuthor = getRaw("SELECT * FROM user WHERE id_group<>'4'");

$allCourseType = getRaw("SELECT * FROM course_type");

?>