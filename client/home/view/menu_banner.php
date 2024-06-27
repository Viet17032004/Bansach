<?php

require _WEB_PATH_ROOT . '/client/home/model/menu_banner.php';


?>


<div class="menu_banner">
    <div class="">
        <div class="card menu_home my-auto">

            <ul class="list-group list-group-flush menu_home my-auto">
                <?php

                if (!empty($allBookType)) {
                    foreach ($allBookType as $value) {
                ?>
                        <a href="?module=book&book_type=<?php echo $value['id']; ?>" class="py-1 px-2 text-decoration-none text-dark type_banner"><?= $value['name'] ?></a>
                <?php
                    }
                }
                ?>

            </ul>

        </div>
    </div>

    <div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <?php 
                if(!empty($arrSlide)):
                    foreach ($arrSlide as $key => $value):
            ?>
            <div style="height: 400px;" class="carousel-item <?php echo $key==0?'active':''; ?>">
            <img src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value; ?>" class="d-block w-100 h-100" alt="...">
            </div>
            <?php endforeach; else: ?>
                <h3 class="text-center">Chưa có slide nào</h3>
            <?php endif; ?>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
    </div>


</div>