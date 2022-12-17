<form method="GET" action="">
    <div class="form-group">
        <label for="username">Search admin by username</label>
        <input type="text" name="username" id="username"
               value="<?php echo isset($_GET['username']) ? $_GET['username'] : '' ?>" class="form-control"/>
        <input type="hidden" name="controller" value="user"/>
        <input type="hidden" name="action" value="index"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Tìm kiếm" name="search" class="btn btn-primary"/>
        <a href="index.php?controller=user" class="btn btn-default">Back</a>
    </div>
</form>

<h2>Danh sách admin</h2>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Avatar</th>
        <th>Created_at</th>
        <th>Updated_at</th>
    </tr>
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $admin): ?>
            <tr>
                <td><?php echo $admin['id'] ?></td>
                <td><?php echo $admin['username'] ?></td>
                <td>
                        <img height="80" src="assets/uploads/<?php echo $admin['avatar'] ?>"/>
                </td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($admin['created_at'])) ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($admin['updated_at'])) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</table>
<?php //echo $pages; ?>