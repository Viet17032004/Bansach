<?php

$allComment = getRaw("SELECT  c.*,u.fullname,u.email,u.phone,b.title,t.name FROM comment as c 
                    INNER JOIN user as u ON c.user_id = u.id 
                    INNER JOIN book as b ON c.book_id = b.id
                    INNER JOIN book_type as t ON b.book_type_id = t.id WHERE parent_id='0' AND book_id<>'' $filter");

?>