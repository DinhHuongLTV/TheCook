<?php
?>
<h2>Chi tiết admin</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $data['id'] ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo $data['username'] ?></td>
    </tr>
    <tr>
        <th>Password</th>
        <td><?php echo $data['password'] ?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <?php if (!empty($data['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $data['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>last_login</th>
        <td><?php echo !empty($data['last_login']) ? date('d-m-Y H:i:s', strtotime($data['last_login'])) : '' ?></td>
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
<a href="index.php?controller=user&action=index" class="btn btn-default">Back</a>