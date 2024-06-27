<?php

$allBook = getRaw("SELECT * FROM book");
$numberBook = count($allBook);

$allClient = getRaw("SELECT * FROM user WHERE id_group='4'");
$numberClient = count($allClient);

$allOrder = getRaw("SELECT * FROM order_pro");
$numberOrder = count($allOrder);

$allCartOrder = getRaw("SELECT * FROM cart_order");

$revenueBook = 0;

foreach ($allCartOrder as $key => $value) {
    $revenueBook += $value['quantity']*$value['price'];
}

$revenueBook = number_format($revenueBook, 0, '.', ',');

?>

<div class="container_my">

<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $numberBook; ?></h3>

                <p>Số lượng sách</p>
              </div>
              <div class="icon">
              <i class="fa fa-book icon"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $numberClient; ?></h3>

                <p>Số lượng khách hàng</p>
              </div>
              <div class="icon">
                <i class="fa fa-user icon"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $numberOrder; ?></h3>

                <p>Đơn hàng</p>
              </div>
              <div class="icon">
              <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $revenueBook; ?></h3>

                <p>Doanh thu</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->



</div>