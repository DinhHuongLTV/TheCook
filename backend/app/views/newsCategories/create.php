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
            <option value="1">Active</option>
            <option value="0">Disabled</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-primary">
        <a href="index.php?controller=newsCategory&action=index" class="btn btn-warning">Back</a>
    </div>
</form>

