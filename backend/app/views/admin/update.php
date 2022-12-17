<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"
               value="<?php echo isset($_POST['username']) ? $_POST['username'] : $data['username'] ?>" disabled>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ue']) ? $data['ue'] : ""?>
        </small>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <img src="assets/uploads/<?php echo $data['avatar']?>" style="height: 50px; width: 50px; border-radius: 50px" alt="admin - avatar">
        <input type="file" class="form-control-file" id="avatar" name="avatar">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ae']) ? $data['ae'] : ""?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Password: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter password" name="password"
               value="<?php echo isset($data['password']) ? $data['password'] : ""?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['pe']) ? $data['pe'] : ""?>
        </small>
    </div>
    <div class="form-group">
        <input type="submit" value="Cập nhật" name="submit" class="btn btn-primary">
        <a href="index.php?controller=user&action=index" class="btn btn-primary">Back</a>
    </div>
</form>
