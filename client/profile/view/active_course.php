
<?php

$myData = _MY_DATA;

$id = $myData['id'];

$allMyCourse = getRaw("SELECT c.*, t.name AS 't_name' FROM my_course AS m INNER JOIN course AS c ON m.course_id=c.id INNER JOIN course_type AS t ON c.course_type_id=t.id WHERE m.user_id='$id' AND m.status<>'1' AND c.status<>'0'");

?>

<h3 class="text-primary">Kích hoạt khóa học SMARTFL:</h3>
<br>
<?php if(!empty($allMyCourse)): ?>
<div class="course_home">
<?php foreach ($allMyCourse as $key => $value): ?>
<div class="item_course border">

<a href="?module=course&action=detail_course&course_id=<?php echo $value['id']; ?>"><img class="w-100 mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a> 

<h6><a href="?module=course&action=detail_course&course_id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h6>

<div class="sub_item_course">
    <small></small>
    <small style="text-align: end;"><?php echo $value['price']; ?> VND</small>
    <h6>Loại: <?php echo $value['t_name']; ?></h6>
    <h6 style="text-align: end;"><?php echo $value['discount']; ?> VND</h6>
</div>

</div>
<?php endforeach; ?>
</div>
<?php else: ?>
    <h4 class="text-danger text-center" style="margin: 70px 0;">Chưa có khóa học nào</h4>
<?php endif; ?>