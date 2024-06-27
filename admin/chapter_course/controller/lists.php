<?php

$data = [
    'titlePage' => 'Chapter'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'chapter_course');

?>


<?php

layout('footer', 'admin');


?>