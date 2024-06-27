
<?php
$body = getRequest('get');

$count = 0;
$filter = '';

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " AND `title` LIKE '%$keywork%' ";
}

if(!empty($body['exam_type'])){
    $exam_type = $body['exam_type'];
    $filter .= " AND `exam_type_id` = '$exam_type' ";
}


require _WEB_PATH_ROOT.'/client/exam/model/lists.php';

$msg = getFlashData('msg');
$type = getFlashData('type');

getAlert($msg, $type);

?>


<div class="filter_course">

<form action="" method="get" class="mx-0 row py-3">

<input type="hidden" name="module" value="<?php echo $module; ?>">

<div class="form-group my-0 col-7">
    <input type="text" name="keywork" value="<?php echo !empty($keywork)?$keywork:''; ?>" class="form-control">
</div>

<div class="form-group my-0 col-3">
    <select name="exam_type" class="form-control">
        <option value="">Chọn</option>
        <?php
            if(!empty($allExamType)):
                foreach ($allExamType as $key => $value):
        ?>
        <option <?php echo !empty($exam_type) && $exam_type == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name'].' - '.$value['id']; ?></option>
        <?php endforeach; endif; ?>
    </select>
</div>

<div class="form-group my-0 col-2">
    <input type="submit" value="Tìm" class="form-control btn btn-primary">
</div>

</form>

</div>

<br>

<?php
    if(!empty($allExam)):
?>

<div class="course_home">

<?php
    foreach ($allExam as $key => $value):
?>

<div class="item_course border">

<a class="text-center d-block" href="?module=exam&action=detail_exam&id=<?php echo $value['id']; ?>"><img class="image_course mx-auto d-block mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>

<h6><a href="?module=exam&action=detail_exam&id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h6>
<p class="text-primary">Loại: <span class="text-warning"><?php echo $value['t_name']; ?></span></p>

<div class="sub_item_course mt-3">
    <p></p>
    <h6 style="text-align: right;" class="text-primary">Giá: <span class="text-warning"><?php echo $value['price']; ?></span> VND</h6>
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

