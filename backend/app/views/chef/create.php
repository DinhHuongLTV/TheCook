<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Tên đăng nhập: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"
               value="<?php echo isset($_POST['username']) ? $_POST['username'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ue']) ? $data['ue'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar: </label>
        <input type="file" class="form-control-file" id="avatar" name="avatar">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ae']) ? $data['ae'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Password: </label>
        <input type="password" class="form-control" id="username" placeholder="Enter password" name="password"
               value="<?php echo isset($_POST['password']) ? $_POST['password'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['pe']) ? $data['pe'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Reenter Passowrd: </label>
        <input type="password" class="form-control" id="username" placeholder="Enter password again" name="password2"
               value="<?php echo isset($_POST['password2']) ? $_POST['password2'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['pe2']) ? $data['pe2'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="category">Hạng mục: </label>
        <select name="category" id="" class="form-control">
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo $category['id'] ?>">
                    <?php echo $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['cae']) ? $data['cae'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="nationality">Quốc tịch: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter nationality" name="nationality"
               value="<?php echo isset($_POST['nationality']) ? $_POST['nationality'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ne']) ? $data['ne'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">First name: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter first name" name="firstname"
               value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['fe']) ? $data['fe'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Last name: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter last name" name="lastname"
               value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['le']) ? $data['le'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="price">Price: </label>
        <input type="text" class="form-control" id="price" placeholder="Enter last name" name="price"
               value="<?php echo isset($_POST['price']) ? $_POST['price'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['pre']) ? $data['pre'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="summary">Mô tả sơ lược: </label>
        <textarea name="summary"
                  placeholder="Enter chef's summary"><?php echo !empty($_POST['summary']) ? $_POST['summary'] : "" ?></textarea>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['se']) ? $data['se'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="content">Mô tả chi tiết: </label>
        <textarea name="description"
                  placeholder="Enter chef's description"><?php echo !empty($_POST['description']) ? $_POST['description'] : "" ?></textarea>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['de']) ? $data['de'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Phone: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter phone number" name="phone"
               value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['phe']) ? $data['phe'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Address: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter address" name="address"
               value="<?php echo isset($_POST['address']) ? $_POST['address'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ade']) ? $data['ade'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Email: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter email" name="email"
               value="<?php echo isset($_POST['email']) ? $_POST['email'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ee']) ? $data['ee'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Jobs: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter jobs" name="jobs"
               value="<?php echo isset($_POST['jobs']) ? $_POST['jobs'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['je']) ? $data['je'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Facebook: </label>
        <input type="text" class="form-control" id="username" placeholder="Enter user's facebook" name="facebook"
               value="<?php echo isset($_POST['facebook']) ? $_POST['facebook'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['fbe']) ? $data['fbe'] : "" ?>
        </small>
    </div>
    <div class="form-group">
        <label for="username">Status: </label>
        <select name="status" id="">
            <option value="1">Active</option>
            <option value="0">Disabled</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-primary">
        <a href="index.php?controller=chefs&action=index" class="btn btn-warning">Back</a>
    </div>
</form>
