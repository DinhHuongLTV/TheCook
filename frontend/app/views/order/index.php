<div class="">
    <div class="container py-5">
        <?php foreach ($orders as $order): ?>
            <?php if ($order['user_id'] == $_SESSION['user']['id']): ?>
                <div class="row mb-3 bg-light">
                    <div class="col-md-4 chef_avatar"></div>
                    <div class="col-md-8 py-1">
                        <h3><?php echo '#'.$order['order_code']?></h3>
                        <p>Đầu bếp được thuê: </p>
                        <p>Địa chỉ: <?php echo $order['address']?></p>
                        <p>Tổng tiền: <?php echo $order['price_total']?></p>
                        <p>Tình trạng thanh toán:
                            <?php if ($order['payment_status'] == 1):?>
                                <i class="bg-success text-light py-1 px-2">Đã thanh toán</i>
                            <?php else:?>
                                <i class="bg-danger text-light py-1 px-2">Chưa thanh toán</i>
                            <?php endif ?>
                        </p>
                        <a href="index.php?controller=order&action=detail&id=<?php echo $order['id']?>" class="btn btn-outline-info text-dark">Chi tiết</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
</div>
