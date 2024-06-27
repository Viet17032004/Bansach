
<?php

$allBlog = getRaw("SELECT b.*, t.name AS 't_name' FROM blog AS b INNER JOIN blog_type AS t ON b.blog_type_id=t.id WHERE b.id<>'$blog_id' AND `status`<>'0' AND blog_type_id='$blog_type'");

if(!empty($allBlog)):
?>

<hr>
<h2 class="text-warning">Các tin tức cùng loại</h2>
<br>
<div class="course_home">
<?php 
    foreach ($allBlog as $key => $value):
?>
<div class="item_course border">

<a href="?module=blog&action=detail_blog&id=<?php echo $value['id']; ?>"><img class="image_course mx-auto d-block mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>
<hr>

<h6><a href="?module=blog&action=detail_blog&id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h6>
<p class="text-primary">Loại: <span class="text-warning"><?php echo $value['t_name']; ?></span></p>

<div class=" mt-3">
    <p style="text-align: end;" class="text-primary">Ngày đăng: <span class="text-warning"><?php echo getTimeFormat($value['create_at'], 'Y-m-d'); ?></span></p>
</div>

</div>

<?php endforeach;?>
</div>
<?php endif; ?>
