
<?php
$body = getRequest('get');

$user_id = isLogin()['user_id'];

$allExam = getRaw("SELECT e.*, m.id AS 'm_id' FROM make_exam AS m INNER JOIN exam AS e ON m.exam_id=e.id WHERE m.user_id='$user_id'");

$msg = getFlashData('msg');
$type = getFlashData('type');

getAlert($msg, $type);

?>

<h2 class="text-primary text-center">LÀM BÀI TRÊN SMARTFL</h2>

<br>

<?php
    if(!empty($allExam)):
?>

<div class="course_home">

<?php
    foreach ($allExam as $key => $value):
?>

<div class="item_course border">

<a href="?module=exam&action=detail_exam&id=<?php echo $value['id']; ?>"><img class="w-100 mx-auto d-block mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>

<h6><a href="?module=exam&action=detail_exam&id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h6>
<p></p>

<div class="sub_item_course mt-3">
    <p></p>
    <h6 style="text-align: right;" class="text-warning"><?php echo $value['price']; ?> VND</h6>
</div>

</div>

<?php
    endforeach;
?>

</div>

<?php
    else:
?>
    <h2 class="text-center text-danger" style="margin: 70px 0;">Không có dữ liệu</h2>
<?php
    endif;
?>

