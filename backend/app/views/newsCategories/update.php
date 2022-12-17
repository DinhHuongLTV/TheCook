<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
               value="<?php echo isset($data['name']) ? $data['name'] : ""?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ne']) ? $data['ne'] : ""?>
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
        <label for="description">Description: </label>
        <textarea class="form-control" id="description" placeholder="Enter description" name="description"><?php echo isset($data['description']) ? $data['description'] : ""?></textarea>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['de']) ? $data['de'] : ""?>
        </small>
    </div>
    <div class="form-group">
        <label for="name">Status: </label>
        <select name="status" id="">
            <?php
            $selected_active = '';
            $selected_disabled = '';
            if (isset($data['status'])) {
                switch ($data['status']) {
                    case 0:
                        $selected_disabled = 'selected';
                        break;
                    case 1:
                        $selected_active = 'selected';
                        break;
                }
            }
            ?>
            <option value="1" <?php echo $selected_active; ?>>Active</option>
            <option value="0" <?php echo $selected_disabled; ?>>Disabled</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Update" name="submit" class="btn btn-primary">
        <a href="index.php?controller=newsCategory&action=index" class="btn btn-warning">Back</a>
    </div>
</form>

