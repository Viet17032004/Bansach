<?php

$group_id = _MY_DATA['id_group'];

?>

<div class="sidebar_profile">

<div class="sidebar_img bg-primary p-2">
<img width="20%" src="<?php echo !empty(_MY_DATA['image'])?_WEB_HOST_IMAGE_CLIENT.'/'._MY_DATA['image']:_WEB_HOST_IMAGE_CLIENT.'/unnamed.jpg'; ?>" class="" alt="User Image">
<h6 class="d-inline-block my-auto text-light"><?php echo isLogin()?_MY_DATA['fullname']:''; ?></h6>
</div>

<ul class="sidebar_nav bg-white">
    <?php if($group_id != 4): ?>
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="p-2 d-block border text-decoration-none">Trang quản trị</a>
    <?php endif; ?>  
    <a href="?module=profile" class="p-2 d-block border text-decoration-none">Thông tin người dùng</a>
    <a href="?module=profile&action=course" class="p-2 d-block border text-decoration-none">Các khóa học đã mua</a>
    <a href="?module=profile&action=result_exam" class="p-2 d-block border text-decoration-none">Điểm các bài kiểm tra</a>
    <a href="?module=profile&action=order" class="p-2 d-block border text-decoration-none">Các đơn hàng</a>
    <a href="?module=profile&action=change_password" class="p-2 d-block border text-decoration-none">Đổi mật khẩu</a>
    <a href="?module=auth&action=logout" class="p-2 d-block border text-decoration-none">Đăng xuất</a>
</ul>

</div>