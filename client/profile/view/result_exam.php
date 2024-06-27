
<?php

$myData = _MY_DATA;

$id = $myData['id'];

$allResultExam = getRaw("SELECT r.*, e.title AS 'e_name' FROM result_exam AS r INNER JOIN exam AS e ON r.exam_id=e.id WHERE r.user_id='$id' ORDER BY r.create_at DESC");

$count = 0;

$msg = getFlashData('msg');
$type = getFlashData('type');


?>


<div class="profile_information bg-white border bra-10 p-3">

<?php getAlert($msg, $type); ?>

<h3>Kết quả bài kiểm tra:</h3>
<hr>

<table class="w-100">
    <thead>
        <tr>
            <th width="5%" class="board_th">STT</th>
            <th width="" class="board_th">Thông tin bài kiểm tra</th>
            <th width="15%" class="board_th">Số câu hỏi</th>
            <th width="15%" class="board_th">Số câu đúng</th>
            <th width="15%" class="board_th">Điểm</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if(!empty($allResultExam)):
                foreach ($allResultExam as $key => $value):
                    $count++;
                    $number_question = $value['number_question'];
                    $number_right = $value['number_right'];
                    $point = ($number_right/$number_question)*10;
        ?>
        <tr>
            <td class="board_td text-center"><?php echo $count; ?></td>
            <td class="board_td">
                <h6>Tên bài: <?php echo $value['e_name']; ?></h6>
                <p><?php echo getTimeFormat($value['create_at'], 'Y-m-d'); ?></p>
            </td>
            <td class="board_td text-center"><?php echo $number_question; ?> câu</td>
            <td class="board_td text-center"><?php echo $number_right; ?> câu</td>
            <td class="board_td text-center"><?php echo $point; ?></td>
        </tr>
        <?php endforeach; else: ?>
            <td class="board_td text-center text-danger" colspan="5">Không có bài kiểm tra nào</td>
        <?php endif; ?>
    </tbody>
</table>


</div>