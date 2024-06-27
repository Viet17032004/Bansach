<?php

$allCourse = getRaw("SELECT c.*, t.name AS 't_name', u.fullname AS 'u_name' FROM course AS c INNER JOIN course_type AS t ON c.course_type_id=t.id INNER JOIN user AS u ON c.author_id=u.id WHERE c.status<>'0' ORDER BY create_at DESC LIMIT 8");

$allBook = getRaw("SELECT b.*, t.name AS 't_name' FROM book AS b INNER JOIN book_type AS t ON b.book_type_id=t.id WHERE `status`<>'0' ORDER BY create_at DESC LIMIT 8");

$allExam = getRaw("SELECT e.*, t.name AS 't_name' FROM exam AS e INNER JOIN exam_type AS t ON e.exam_type_id=t.id WHERE `status`<>'0' ORDER BY create_at DESC LIMIT 8");


?>