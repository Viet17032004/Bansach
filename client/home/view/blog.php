

<?php

require _WEB_PATH_ROOT . '/client/home/model/blog.php';

?>

<hr>

<br>

<h3 class="text-primary">TIN TỨC</h3>

<br>
<div class="box_blog_home">
    <?php
    if (!empty($allBlog)) {
        foreach ($allBlog as $value) {
            extract($value);

    ?>
            <div class="item_blog p-1" style="">
                <a href="?module=blog&action=detail_blog&id=<?php echo $id; ?>"> <img class="w-100 bra-10" src="<?php echo _WEB_HOST_TEMPLATE . '/client/assets/image/' . $image; ?>" alt=""></a>
                <a href="?module=blog&action=detail_blog&id=<?php echo $id; ?>" class="text-decoration-none">
                    <h5 class="mx-2"><?= $value['title'] ?></h5>
                    <p class="mt-3 mx-2">Ngày đăng: <span class="text-warning"><?php echo getTimeFormat($create_at, "Y/m/d"); ?></span></p>
                </a>
            </div>
    <?php
        }
    }
    ?>

    <!-- <a href="" class="ml-auto w-100">Xem thêm tin tức >></a> -->

</div>