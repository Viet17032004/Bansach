
<?php

$data = [
    'titlePage' => 'Danh sách bình luận con sách'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('children_book', 'admin', 'comment');

?>


<?php

layout('footer', 'admin');



?>


?>