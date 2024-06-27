<?php

$group_id = _MY_DATA['id_group'];

?>
 
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <h2 class="text-center brand-text font-weight-light">SMARTFL</h2>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo !empty(_MY_DATA['image'])?_WEB_HOST_IMAGE_CLIENT.'/'._MY_DATA['image']:_WEB_HOST_IMAGE_CLIENT.'/unnamed.jpg'; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo !empty(_MY_DATA['fullname'])?_MY_DATA['fullname']:''; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="nav-link <?php echo empty($_GET['module'])?'active':''; ?>">
              <i class="fa fa-home mx-2"></i>
              <p>
                Bảng điều khiển
              </p>
            </a>
          </li>
          <?php if(checkPermission($group_id, 'group', 'lists')): ?>
          <li class="nav-item">
            <a href="?module=groups" class="nav-link <?php echo getActive(['groups', 'permission'])?'active':''; ?>" >
            <i class="fa fa-users mx-2"></i>
              <p>
                Cấp bậc
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if(checkPermission($group_id, 'admin', 'lists_admin')): ?>
          <li class="nav-item">
            <a href="?module=user&action=lists_admin" class="nav-link <?php echo getAction(['lists_admin', 'add_admin', 'fix_admin'])?'active':''; ?>" >
            <i class="fa fa-user mx-2"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if(checkPermission($group_id, 'staff', 'lists_staff')): ?>
          <li class="nav-item">
            <a href="?module=user&action=lists_staff" class="nav-link <?php echo getAction(['lists_staff', 'add_staff', 'fix_staff'])?'active':''; ?>" >
            <i class="fa fa-user mx-2"></i>
              <p>
                Nhân viên
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if(checkPermission($group_id, 'user', 'lists_user') || checkPermission($group_id, 'user', 'lists_tearch') || checkPermission($group_id, 'user', 'lists_client')): ?>
          <li class="nav-item has-treeview <?php echo getAction(['lists_user', 'add_user', 'fix_user', 'delete_user', 'lists_tearch', 'lists_client'])?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getAction(['lists_user', 'add_user', 'fix_user', 'delete_user', 'lists_tearch', 'lists_client'])?'active':''; ?>">
            <i class="fa fa-user mx-2"></i>
              <p>
                Tài khoản
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(checkPermission($group_id, 'user', 'lists_user')): ?>
              <li class="nav-item">
                <a href="?module=user&action=lists_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'user', 'lists_tearch')): ?>
              <li class="nav-item">
                <a href="?module=user&action=lists_tearch" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Giáo viên</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'user', 'lists_client')): ?>
              <li class="nav-item">
                <a href="?module=user&action=lists_client" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Khách hàng</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>
          <?php if(checkPermission($group_id, 'blog', 'lists') || checkPermission($group_id, 'blog_type', 'lists')): ?>
          <li class="nav-item has-treeview <?php echo getActive(['blog_type', 'blog'])?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getActive(['blog_type', 'blog'])?'active':''; ?>">
              <i class="fa fa-blog mx-2"></i>
              <p>
                Bài viết
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(checkPermission($group_id, 'blog', 'lists')): ?>
              <li class="nav-item">
                <a href="?module=blog" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'blog_type', 'lists')): ?>
              <li class="nav-item">
                <a href="?module=blog_type" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>
          <?php if(checkPermission($group_id, 'course', 'lists') || checkPermission($group_id, 'course_type', 'lists')): ?>
          <li class="nav-item has-treeview <?php echo getActive(['course_type', 'course', 'chapter_course', 'exercise_course'])?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getActive(['course_type', 'course', 'chapter_course', 'exercise_course'])?'active':''; ?>">
              <i class="fa fa-video mx-2"></i>
              <p>
                Khóa học
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(checkPermission($group_id, 'course', 'lists')): ?>
              <li class="nav-item">
                <a href="?module=course" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'course_type', 'lists')): ?>
              <li class="nav-item">
                <a href="?module=course_type" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(checkPermission($group_id, 'exam', 'lists') || checkPermission($group_id, 'exam_type', 'lists')): ?>
          <li class="nav-item has-treeview <?php echo getActive(['exam', 'exam_type', 'question_exam'])?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getActive(['exam', 'exam_type', 'question_exam'])?'active':''; ?>">
              <i class="fab fa-earlybirds mx-2"></i>
              <p>
                Bài kiểm tra
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(checkPermission($group_id, 'exam', 'lists')): ?>
              <li class="nav-item">
                <a href="?module=exam" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'exam_type', 'lists')): ?>
              <li class="nav-item">
                <a href="?module=exam_type" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>


          <?php if(checkPermission($group_id, 'book', 'lists') || checkPermission($group_id, 'book_type', 'lists')): ?>
          <li class="nav-item has-treeview <?php echo getActive(['book', 'book_type'])?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getActive(['book', 'book_type'])?'active':''; ?>">
            <i class="fa fa-book mx-2"></i>
              <p>
                Sách
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(checkPermission($group_id, 'book', 'lists')): ?>
              <li class="nav-item">
                <a href="?module=book" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'book_type', 'lists')): ?>
              <li class="nav-item">
                <a href="?module=book_type" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>


          <?php if(checkPermission($group_id, 'order', 'lists')): ?>
          <li class="nav-item">
            <a href="?module=cart" class="nav-link <?php echo getActive(['cart'])?'active':''; ?>">
              <i class="fa fa-truck mx-1"></i>
              <p>
                Đơn hàng
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <?php endif; ?>


          <?php if(checkPermission($group_id, 'comment', 'comment_book') || checkPermission($group_id, 'comment', 'comment_course')): ?>
          <li class="nav-item has-treeview <?php echo getActive(['comment'])?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getActive(['comment',])?'active':''; ?>">
            <i class="fa fa-comment mx-2"></i>
              <p>
                Bình luận
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(checkPermission($group_id, 'comment', 'comment_book')): ?>
              <li class="nav-item">
                <a href="?module=comment&action=lists_book" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bình luận sách</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'comment', 'comment_course')): ?>
              <li class="nav-item">
                <a href="?module=comment&action=lists_course" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bình luận khóa học</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(checkPermission($group_id, 'option', 'header') || checkPermission($group_id, 'option', 'slide') || checkPermission($group_id, 'option', 'footer') || checkPermission($group_id, 'option', 'about') || checkPermission($group_id, 'option', 'contact')): ?>
          <li class="nav-item has-treeview <?php echo getActive(['option'])?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getActive(['option'])?'active':''; ?>">
            <i class="fa fa-cog mx-2"></i>
              <p>
                Option
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(checkPermission($group_id, 'option', 'header')): ?>
              <li class="nav-item">
                <a href="?module=option&action=header" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Header</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'option', 'slide')): ?>
              <li class="nav-item">
                <a href="?module=option&action=slide" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slide</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'option', 'footer')): ?>
              <li class="nav-item">
                <a href="?module=option&action=footer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Footer</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'option', 'about')): ?>
              <li class="nav-item">
                <a href="?module=option&action=about" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Giới thiệu</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(checkPermission($group_id, 'option', 'contact')): ?>
              <li class="nav-item">
                <a href="?module=option&action=contact" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liên hệ</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(checkPermission($group_id, 'statistics', 'lists')): ?>
          <li class="nav-item has-treeview <?php echo getActive(['statistics'])?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getActive(['statistics'])?'active':''; ?>">
            <i class="fa fa-align-left mx-2"></i>
              <p>
                Thống kê
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?module=statistics&action=book" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sách</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Khóa học</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bài kiểm tra</p>
                </a>
              </li> -->
            </ul>
          </li>
          <?php endif; ?>

          <li class="nav-item">
            <a href="" class="nav-link active text-center">
              <p>
                END SIDEBAR
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


