<?php
$allBookType = getRaw("SELECT * FROM book_type ORDER BY id DESC");

// tìm giá min max

$Price_type = getRaw("SELECT *,b.id as b_id, b.price , count(b.id) as soluong ,  b.book_type_id,
  MIN(b.price) as price_min ,
 MAX(b.price) as price_max, bt.name as 'bt_name'
FROM book AS b JOIN book_type AS bt ON bt.id=b.book_type_id 
GROUP BY bt.id");


$allBook = getRaw("SELECT * FROM book");

$book_detail = getRaw("SELECT *, book.id as book_id from book  JOIN book_type  ON book.book_type_id=book_type.id
GROUP BY book.id");



//test


// số lượng đã bán

$countBookSold = getRaw("SELECT *, bt.id as book_type_id, b.id as book_id, SUM(c.quantity) as sum FROM cart_order as c 
JOIN book as b ON c.book_id=b.id
JOIN book_type as bt ON b.book_type_id=bt.id
GROUP BY b.book_type_id, c.book_id");


// foreach ($countBookSold as $value) {
//   echo $value['book_id'];
//   echo "<br>";
// }
