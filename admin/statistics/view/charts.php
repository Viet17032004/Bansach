<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'statistics', 'lists')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

require _WEB_PATH_ROOT . '/admin/statistics/model/book.php';
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Danh mục', 'Số lượng'],
      <?php
      foreach ($Price_type as $value) {
        extract($value);
        echo "['$bt_name', $soluong],";
      }

      ?>
    ]);

    var options = {
      title: 'Biểu đồ thống kê số lượng sản phẩm theo danh mục'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>

<body>
  <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>

<a href="?module=statistics&action=book">Quay lại</a>