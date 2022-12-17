<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"
               value="<?php echo isset($data['username']) ? $data['username'] : ""?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ue']) ? $data['ue'] : ""?>
        </small>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" class="form-control-file" id="avatar" name="avatar">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ae']) ? $data['ae'] : ""?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Password: </label>
        <input type="password" class="form-control" id="username" placeholder="Enter password" name="password"
               value="<?php echo isset($data['password']) ? $data['password'] : ""?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['pe']) ? $data['pe'] : ""?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Reenter Passowrd: </label>
        <input type="password" class="form-control" id="username" placeholder="Enter password again" name="password2"
               value="<?php echo isset($data['password2']) ? $data['password2'] : ""?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['pe2']) ? $data['pe2'] : ""?>
        </small>
    </div>
    <div class="form-group">
        <input type="submit" value="Tạo" name="submit" class="btn btn-primary">
        <a href="index.php?controller=user&action=index" class="btn btn-warning">Back</a>
    </div>
</form>
