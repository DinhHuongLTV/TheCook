<?php
    if (isset($_SESSION['order_detail'])) {
        $_SESSION['order_detail']['order_code'] = "order-".time() % 10000;
    }
?>
<div class="container py-5 bg-light">
    <div class="row">
        <form action="" method="post" class="p-4">
            <div class="form-group my-3">
                <label for="order_code">Mã đơn hàng</label>
                <input class="form-control" type="text" name="order_code" id="" value="<?php echo $_SESSION['order_detail']['order_code']?>" readonly>
            </div>
            <div class="form-group my-3">
                <label for="">Tên người thuê:</label>
                <input class="form-control" type="text" name="fullname" id="" value="<?php echo $_SESSION['user']['first_name'] ." ". $_SESSION['user']['last_name'] ?>" readonly>
            </div>
            <div class="form-group my-3">
                <label for="">Địa chỉ:</label>
                <input class="form-control" type="text" name="address" id="" value="<?php echo empty($_SESSION['order_detail']['booking_place']) ? $_SESSION['user']['address'] : $_SESSION['order_detail']['booking_place']?>" readonly>
            </div>
            <div class="form-group my-3">
                <label for="">Số điện thoại người thuê:</label>
                <input class="form-control" type="text" name="phone" id="" value="<?php echo $_SESSION['user']['phone']?>" readonly>
            </div>
            <div class="form-group my-3">
                <label for="">Ngày thuê:</label>
                <input class="form-control" type="text" name="date" id="" value="<?php echo $_SESSION['order_detail']['booking_date']?>" readonly>
            </div>
            <div class="form-group my-3">
                <label for="">Giờ thuê:</label>
                <input class="form-control" type="text" name="hour" id="" value="<?php echo $_SESSION['order_detail']['booking_hour']?>" readonly>
            </div>
            <div class="form-group my-3">
                <label for="">Thời gian thuê:</label>
                <input class="form-control" type="text" name="time" id="" value="<?php echo $_SESSION['order_detail']['booking_time']?>" readonly> tiếng
            </div>
            <div class="form-group my-3">
                <label for="summary">Ghi chú: </label>
                <textarea name="note" placeholder="Enter some notes"></textarea>
            </div>
            <div class="form-group my-3">
                <label for="">Thanh toán</label>
                <input class="" type="checkbox" name="payment" id="">
            </div>
            <div class="form-group my-3">
                <label for="">Giá tiền</label>
                <input class="form-control" type="text" name="price" id="" value="<?php echo $_SESSION['order_detail']['booking_time'] * $chef['price'] ?>" readonly>
            </div>
            <div class="form-group">
                <input type="submit" value="Xác nhận" name="submit" class="btn btn-danger">
                <a href="index.php?controller=chef&action=index" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>