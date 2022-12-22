<div class="info_container">
    <div class="container bg-light p-5">
        <h3 class="mb-4">Mã đơn hàng: <?php echo '#'.$order['order_code']?></h3>
        <p class="mb-4">Tên khách hàng: <?php echo $order['fullname']?></p>
        <p class="mb-4">Đầu bếp được thuê: </p>
        <p class="mb-4">Số điện thoại đặt lịch: <?php echo $order['phone']?></p>
        <p class="mb-4">Email khách hàng: <?php echo $order['email']?></p>
        <p class="mb-4">Địa chỉ: <?php echo $order['address']?></p>
        <p class="mb-4">Ngày đặt: <?php echo date("d-m-Y", strtotime($order['booking_date']))?></p>
        <p class="mb-4">Ngày tạo: <?php echo date("d-m-Y", strtotime($order['created_at']))?></p>
        <p class="mb-4">Số giờ thuê: <?php echo $order['booking_hour']?></p>
        <p class="mb-4">Tổng tiền: <?php echo $order['price_total']?></p>
        <p class="mb-4">Ghi chú thêm: <?php echo $order['note']?></p>
        <div class="mb-4">Trạng thái:
            <?php if ($order['payment_status'] == 1):?>
                <i class="bg-success text-light py-1 px-2">Đã thanh toán</i>
            <?php else:?>
                <i class="bg-danger text-light py-1 px-2">Chưa thanh toán</i>
            <?php endif ?>
        </div>
        <a href="index.php?controller=order&action=index" class="btn btn-outline-secondary">Back</a>
    </div>
</div>