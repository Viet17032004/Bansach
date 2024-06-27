<?php


$allExam = getRaw("SELECT e.*, t.name AS 't_name' FROM exam AS e INNER JOIN exam_type AS t ON e.exam_type_id=t.id WHERE e.id<>'$exam_id' AND e.status<>'0' AND exam_type_id='$exam_type'");

if(!empty($allExam)):

?>

<hr>
<br>

<h3>Các đề thi cùng loại</h3>
<br>

<div class="owl-carousel owl-theme">
<!-- <div class=""> -->

    <?php foreach ($allExam as $key => $value): ?>
    <div class="item">
    <div class="item_exam">

    <a href="?module=exam&action=detail_exam&id=<?php echo $value['id']; ?>"><img class="image_course mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>

    <h6><a href="?module=exam&action=detail_exam&id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h6>
    <p class="text-primary">Loại: <span class="text-warning"><?php echo $value['t_name']; ?></span></p>

    <div class="sub_item_exam">
        <small></small>
        <p class="mb-0"></p>
        <span class="mb-0 text-primary" style="text-align: end;"> Giá: <span class="text-warning"><?php echo $value['price']; ?></span> VND</span>
    </div>

    </div>
    </div>
    <?php endforeach; ?>

</div>
<?php endif; ?>