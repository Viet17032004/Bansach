<?php

$numberBlogType = getCountRows("SELECT id FROM blog_type $filter");

$totalPage = ceil($numberBlogType/_PAGE);

$limitS = ($page-1)*_PAGE;
$limitE = _PAGE;

$allBlogType = getRaw("SELECT * FROM blog_type $filter ORDER BY id DESC LIMIT $limitS, $limitE");

?>