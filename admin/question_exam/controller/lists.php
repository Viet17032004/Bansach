<?php

$data = [
    'titlePage' => 'Question'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'question_exam');

?>


<?php

layout('footer', 'admin');


?>