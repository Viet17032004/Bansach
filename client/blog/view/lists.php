<?php

$body = getRequest('get');

$count = 0;
$filter = '';
$urlFilter = '';

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " AND `title` LIKE '%$keywork%' ";
    $urlFilter .= "&keywork=$keywork";
}

if(!empty($body['blog_type'])){
    $blog_type = $body['blog_type'];
    $filter .= " AND `blog_type_id` = '$blog_type' ";
    $urlFilter .= "&blog_type=$blog_type";
}

require _WEB_PATH_ROOT . '/client/blog/model/lists.php';

?>


<div class="filter_course">

    <form action="" method="get" class="mx-0 row py-3">

        <input type="hidden" name="module" value="<?php echo $module; ?>">

        <div class="form-group my-0 col-7">
            <input type="text" name="keywork" value="<?php echo !empty($keywork) ? $keywork : ''; ?>" class="form-control">
        </div>

        <div class="form-group my-0 col-3">
            <select name="blog_type" class="form-control">
                <option value="">Chọn</option>
                <?php
                if (!empty($allBlogType)) :
                    foreach ($allBlogType as $key => $value) :
                ?>
                        <option <?php echo !empty($blog_type) && $blog_type == $value['id'] ? 'selected' : ''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name'] . ' - ' . $value['id']; ?></option>
                <?php endforeach;
                endif; ?>
            </select>
        </div>

        <div class="form-group my-0 col-2">
            <input type="submit" value="Tìm" class="form-control btn btn-primary">
        </div>

    </form>

</div>

<br>


<div class="course_home">
    <?php
    if (!empty($allBlog)) {
        foreach ($allBlog as $value) {
            extract($value);
    ?>
<div class="item_course border">

<a href="?module=blog&action=detail_blog&id=<?php echo $value['id']; ?>"><img class="image_course mx-auto d-block mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>
<hr>

<h6><a href="?module=blog&action=detail_blog&id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h6>
<p class="text-primary">Loại: <span  class="text-warning"><?php echo $value['t_name']; ?></span></p>

<div class=" mt-3">
    <p style="text-align: end;" class="text-primary">Ngày đăng: <span class="text-warning"><?php echo getTimeFormat($value['create_at'], 'Y-m-d'); ?></span></p>
</div>

</div>
    <?php
        }
    }
    ?>
</div>
        
<?php if(empty($allBlog)) echo '<h3 class="text-center text-danger" style="margin: 70px 0;">Không có dữ liệu</h3>'; ?>
