<form method="GET" action="">
    <div class="form-group">
        <label for="username">Search news by name</label>
        <input type="text" name="name" id="name"
               value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>" class="form-control"/>
        <input type="hidden" name="controller" value="user"/>
        <input type="hidden" name="action" value="index"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Tìm kiếm" name="search" class="btn btn-primary"/>
        <a href="index.php?controller=news" class="btn btn-default">Back</a>
    </div>
</form>

<h2>Danh sách Tin</h2>
<a href="index.php?controller=news&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Ảnh</th>
        <th>Nội dung tóm tắt</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $news): ?>
            <tr>
                <td><?php echo $news['id'] ?></td>
                <td><?php echo $news['name'] ?></td>
                <td>
                    <img height="80" src="assets/uploads/<?php echo $news['avatar'] ?>"/>
                </td>
                <td><?php echo $news['summary'] ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($news['created_at'])) ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($news['updated_at'])) ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=news&action=detail&id=" . $news['id'];
                    $url_update = "index.php?controller=news&action=update&id=" . $news['id'];
                    $url_delete = "index.php?controller=news&action=delete&id=" . $news['id'];
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