<?php
$numberBlog = getCountRows("SELECT b.id FROM blog AS b INNER JOIN blog_type AS t ON b.blog_type_id=t.id INNER JOIN user AS u ON b.author_id=u.id $filter");

$totalPage = ceil($numberBlog / _PAGE);

$limitS = ($page - 1) * _PAGE;
$limitE = _PAGE;

$allBlog = getRaw("SELECT b.*, t.name AS 't_name', u.fullname AS 'u_name' FROM blog AS b INNER JOIN blog_type AS t ON b.blog_type_id=t.id INNER JOIN user AS u ON b.author_id=u.id $filter ORDER BY id DESC LIMIT $limitS, $limitE");

$allAuthor = getRaw("SELECT * FROM user WHERE id_group<>'4'");

$allBlogType = getRaw("SELECT * FROM blog_type");
