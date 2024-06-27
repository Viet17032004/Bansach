<?php

$data = [
    'titlePage' => 'Danh mục bài viết'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'blog_type');

?>


<?php

layout('footer', 'admin');


?>