<?php

$data = [
    'titlePage' => 'Danh sách bình luận sách'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board_book', 'admin', 'comment');

?>


<?php

layout('footer', 'admin');



?>