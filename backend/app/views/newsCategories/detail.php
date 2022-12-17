<?php
?>
<h2>Chi tiết admin</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $data['id'] ?></td>
    </tr>
    <tr>
        <th>Tên hạng mục</th>
        <td><?php echo $data['name'] ?></td>
    </tr>
    <tr>
        <th>Ảnh minh họa</th>
        <td>
            <?php if (!empty($data['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $data['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Mô tả</th>
        <td>
            <?php echo !empty($data['description']) ? $data['description'] : "" ?>
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <?php echo $data['status'] == 1 ? "Active" : "Disabled";
            ?>
        </td>
    </tr>
    <tr>
        <th>Ngày tạo</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($data['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Ngày cập nhật</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($data['updated_at'])) ?></td>
    </tr>
</table>
<a href="index.php?controller=newsCategory&action=index" class="btn btn-default">Back</a>