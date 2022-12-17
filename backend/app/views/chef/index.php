<form method="GET" action="">
    <div class="form-group">
        <label for="username">Search chef by username</label>
        <input type="text" name="username" id="username"
               value="<?php echo isset($_GET['username']) ? $_GET['username'] : 'unknown' ?>" class="form-control"/>
        <input type="hidden" name="controller" value="user"/>
        <input type="hidden" name="action" value="index"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Tìm kiếm" name="search" class="btn btn-primary"/>
        <a href="index.php?controller=chefs" class="btn btn-default">Back</a>
    </div>
</form>

<h2>Danh sách đầu bếp</h2>
<a href="index.php?controller=chefs&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Avatar</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Ngày tham gia</th>
        <th>Ngày cập nhật</th>
        <th></th>
    </tr>
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $chef): ?>
            <tr>
                <td><?php echo $chef['id'] ?></td>
                <td><?php echo $chef['username'] ?></td>
                <td>
                    <img height="80" src="assets/uploads/<?php echo $chef['avatar'] ?>"/>
                </td>
                <td><?php echo $chef['first_name'] ?></td>
                <td><?php echo $chef['last_name'] ?></td>
                <td><?php echo $chef['email'] ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($chef['created_at'])) ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($chef['updated_at'])) ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=chefs&action=detail&id=" . $chef['id'];
                    $url_update = "index.php?controller=chefs&action=update&id=" . $chef['id'];
                    $url_delete = "index.php?controller=chefs&action=delete&id=" . $chef['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Cập nhật" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</table>
<?php //echo $pages; ?>