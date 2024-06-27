<?php

$detailBlog = getRow("SELECT * FROM blog WHERE id='$id'");

$allBlogType = getRaw("SELECT * FROM blog_type");


     ?>  