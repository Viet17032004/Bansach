<?php


$allComment = getRaw("SELECT  c.*,u.fullname,u.email,u.phone,s.title,t.name FROM comment as c 
INNER JOIN user as u ON c.user_id = u.id 
INNER JOIN course as s ON c.course_id = s.id
INNER JOIN course_type t ON s.course_type_id = t.id WHERE parent_id='0' AND course_id<>'' $filter");

?>