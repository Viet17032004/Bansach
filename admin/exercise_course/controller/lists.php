<?php

$data = [
    'titlePage' => 'Exercise'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'exercise_course');

?>


<?php

layout('footer', 'admin');


?>