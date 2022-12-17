<?php
?>
<h2>Chi tiết Đầu Bếp</h2>
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
        <th>Hạng mục</th>
        <td><?php echo $data['category']['name']?></td>
    </tr>
    <tr>
        <th>Quốc tịch</th>
        <td><?php echo $data['nationality']?></td>
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
        <th>First name</th>
        <td><?php echo $data['first_name'] ?></td>
    </tr>
    <tr>
        <th>Last name</th>
        <td><?php echo $data['last_name'] ?></td>
    </tr>
    <tr>
        <th>Mô tả ngắn</th>
        <td><?php echo $data['summary']?></td>
    </tr>
    <tr>
        <th>Mô tả chi tiết</th>
        <td><?php echo $data['description']?></td>
    </tr>
    <tr>
        <th>Address</th>
        <td><?php echo $data['address'] ?></td>
    </tr>
    <tr>
        <th>Phone</th>
        <td><?php echo $data['phone'] ?></td>
    </tr>
    <tr>
        <th>Jobs</th>
        <td><?php echo $data['jobs'] ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo $data['email'] ?></td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?php echo $data['price'] ?></td>
    </tr>
    <tr>
        <th>Facebook</th>
        <td><?php echo $data['facebook'] ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <?php echo $data['status'] == 1 ? "Active" : "Disabled";
            ?>
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
<a href="index.php?controller=chefs&action=index" class="btn btn-default">Back</a>