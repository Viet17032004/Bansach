
<?php
$body = getRequest('get');

$count = 0;
$filter = '';
$urlFilter = '';

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " AND c.title LIKE '%$keywork%' ";
    $urlFilter .= "&keywork=$keywork";
}

if(!empty($body['course_type'])){
    $course_type = $body['course_type'];

        $filter .= " AND c.course_type_id = '$course_type' ";

    $urlFilter .= "&course_type=$course_type";
}

if(!empty($body['author_id'])){
    $author_id = $body['author_id'];
        $filter .= " AND c.author_id = '$author_id' ";
    $urlFilter .= "&author_id=$author_id";
}

require _WEB_PATH_ROOT.'/client/course/model/lists.php';

?>


<div class="filter_course">

<form action="" method="get" class="mx-0 row py-3">

<input type="hidden" name="module" value="<?php echo $module; ?>">

<div class="form-group my-0 col-7">
    <input type="text" name="keywork" value="<?php echo !empty($keywork)?$keywork:''; ?>" class="form-control">
</div>

<div class="form-group my-0 col-3">
    <select name="course_type" class="form-control">
        <option value="">Chọn</option>
        <?php
            if(!empty($allCourseType)):
                foreach ($allCourseType as $key => $value):
        ?>
        <option <?php echo !empty($course_type) && $course_type == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name'].' - '.$value['id']; ?></option>
        <?php endforeach; endif; ?>
    </select>
</div>

<!-- <div class="form-group my-0 col-3">
    <select name="author_id" class="form-control">
        <option value="">Chọn</option>
        <?php
            if(!empty($allAuthor)):
                foreach ($allAuthor as $key => $value):
        ?>
        <option <?php echo !empty($author_id) && $author_id == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['fullname'].' - '.$value['email']; ?></option>
        <?php endforeach; endif; ?>
    </select>
</div> -->

<div class="form-group my-0 col-2">
    <input type="submit" value="Tìm" class="form-control btn btn-primary">
</div>

</form>

</div>

<br>

<?php if(!empty($allCourse)): ?>
<div class="course_home">
<?php
    foreach ($allCourse as $key => $value):
?>
<div class="item_course border">

<a class="d-block text-center" href="?module=course&action=detail_course&course_id=<?php echo $value['id']; ?>"><img class="image_course mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>
<hr>
<h5 class="mb-2"><a href="?module=course&action=detail_course&course_id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h5>
<div class="sub_item_course">
    <small></small>
    <!-- <small style="text-align: end;" class=""><?php echo $value['price']; ?> VND</small> -->
    <small style="text-align: end;" class=""></small>
    <p class="text-primary">Loại: <span class="text-warning"><?php echo $value['t_name']; ?></span></p>
    <h6 style="text-align: end;" class="text-primary">Giá: <span class="text-warning"><?php echo $value['price']; ?></span> VND</h6>
</div>

</div>
<?php endforeach; ?>
</div>
<?php
    else:
        echo '<h3 class="text-center text-danger" style="margin: 70px 0;">Không có dữ liệu</h3>';
    endif;
?>