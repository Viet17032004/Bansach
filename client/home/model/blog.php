<?php

$allBlog = getRaw("SELECT b.*, t.name AS 't_name', u.fullname AS 'u_name' FROM blog AS b INNER JOIN blog_type AS t ON b.blog_type_id=t.id INNER JOIN user AS u ON b.author_id=u.id WHERE b.status<>'0' ORDER BY create_at DESC LIMIT 4");
