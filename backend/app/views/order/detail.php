<?php
?>
<h2>Chi tiết nội dung tin</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $data['id'] ?></td>
    </tr>
    <tr>
        <th>Tên người đặt</th>
        <td><?php echo $data['fullname'] ?></td>
    </tr>
    <tr>
        <th>Mã đơn hàng</th>
        <td><?php echo $data['order_code'] ?></td>
    </tr>
    <tr>
        <th>Giá trị đơn hàng</th>
        <td><?php echo $data['price_total'] ?></td>
    </tr>
    <tr>
        <th>Nội dung</th>
        <td><?php echo $data['content'] ?></td>
    </tr>
    <tr>
        <th>Trạng thái thanh toán</th>
        <td><?php echo $data['payment_status'] ?></td>
    </tr>
    <tr>
        <th>created_at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($data['created_at'])) ?></td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($data['updated_at'])) ?></td>
    </tr>
</table>
<a href="index.php?controller=news&action=index" class="btn btn-default">Back</a>