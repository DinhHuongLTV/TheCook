<form method="GET" action="">
    <div class="form-group">
        <label for="username">Tìm kiếm hạng mục</label>
        <input type="text" name="username" id="username"
               value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>" class="form-control"/>
        <input type="hidden" name="controller" value="user"/>
        <input type="hidden" name="action" value="index"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Tìm kiếm" name="search" class="btn btn-primary"/>
        <a href="index.php?controller=newsCategory" class="btn btn-default">Back</a>
    </div>
</form>

<h2>Danh sách hạng mục</h2>
<a href="index.php?controller=newsCategory&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Avatar</th>
        <th>Status</th>
        <th></th>
    </tr>
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $category): ?>
            <tr>
                <td><?php echo $category['id'] ?></td>
                <td><?php echo $category['name'] ?></td>
                <td>
                    <img height="100" src="assets/uploads/<?php echo $category['avatar'] ?>"/>
                </td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=newsCategory&action=detail&id=" . $category['id'];
                    $url_update = "index.php?controller=newsCategory&action=update&id=" . $category['id'];
                    $url_delete = "index.php?controller=newsCategory&action=delete&id=" . $category['id'];
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