<form method="GET" action="">
    <div class="form-group">
        <label for="username">Search order by name</label>
        <input type="text" name="name" id="name"
               value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>" class="form-control"/>
        <input type="hidden" name="controller" value="user"/>
        <input type="hidden" name="action" value="index"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Tìm kiếm" name="search" class="btn btn-primary"/>
        <a href="index.php?controller=order" class="btn btn-default">Back</a>
    </div>
</form>

<h2>Danh sách đơn hàng</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Mã đơn hàng</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $order): ?>
            <tr>
                <td><?php echo $order['id'] ?></td>
                <td><?php echo $order['order_code'] ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($order['updated_at'])) ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=order&action=detail&id=" . $order['id'];
                    $url_delete = "index.php?controller=order&action=delete&id=" . $order['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                            class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</table>
<?php //echo $pages; ?>