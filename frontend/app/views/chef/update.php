<div class="info_container">
    <div class="container py-5 bg-light">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group my-3">
                <label for="username">Tên đăng nhập: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter username"
                       name="username"
                       value="<?php echo isset($_POST['username']) ? $_POST['username'] : $data['username'] ?>"
                       disabled>
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ue']) ? $data['ue'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="avatar">Avatar: </label>
                <?php if(isset($data['avatar'])):?>
                    <img src="../backend/assets/uploads/<?php echo $data['avatar']?>" alt="Ảnh đại diện"
                         style="height: 50px; width: 50px; border-radius: 50px">
                <?php endif;?>
                <input type="file" class="form-control-file" id="avatar" name="avatar">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ae']) ? $data['ae'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="password">Password: </label>
                <input type="password" class="form-control" id="username" placeholder="Enter password"
                       name="password"
                       value="<?php echo isset($_POST['password']) ? $_POST['password'] : $data['password'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['pe']) ? $data['pe'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="category">Hạng mục: </label>
                <select name="category" id="" class="form-control">
                    <?php foreach ($data['categories'] as $category): ?>
                        <option value="<?php echo $category['id']?>" <?php echo $data['category']==$category['id']
                            ? "selected" : "" ?>
                        >
                            <?php echo $category['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['cae']) ? $data['cae'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="nationality">Quốc tịch: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter nationality"
                       name="nationality"
                       value="<?php echo isset($_POST['nationality']) ? $_POST['nationality'] : $data['nationality'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ne']) ? $data['ne'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">First name: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter first name"
                       name="firstname"
                       value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : $data['firstname'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['fe']) ? $data['fe'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Last name: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter last name"
                       name="lastname"
                       value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : $data['lastname'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['le']) ? $data['le'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="price">Price: </label>
                <input type="text" class="form-control" id="price" placeholder="Enter price"
                       name="price"
                       value="<?php echo isset($_POST['price']) ? $_POST['price'] : $data['price'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['pre']) ? $data['pre'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="summary">Mô tả sơ lược: </label>
                <textarea name="summary"
                          placeholder="Enter chef's summary"><?php echo !empty($_POST['summary']) ? $_POST['summary'] : $data['summary'] ?></textarea>
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['se']) ? $data['se'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="content">Mô tả chi tiết: </label>
                <textarea name="description"
                          placeholder="Enter chef's description"><?php echo !empty($_POST['description']) ? $_POST['description'] : $data['description'] ?></textarea>
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['de']) ? $data['de'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Phone: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter phone number"
                       name="phone"
                       value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $data['phone'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['phe']) ? $data['phe'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Address: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter address" name="address"
                       value="<?php echo isset($_POST['address']) ? $_POST['address'] : $data['address'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ade']) ? $data['ade'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Email: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter email" name="email"
                       value="<?php echo isset($_POST['email']) ? $_POST['email'] : $data['email'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ee']) ? $data['ee'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Jobs: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter jobs" name="jobs"
                       value="<?php echo isset($_POST['jobs']) ? $_POST['jobs'] : $data['jobs'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['je']) ? $data['je'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Facebook: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter user's facebook"
                       name="facebook"
                       value="<?php echo isset($_POST['facebook']) ? $_POST['facebook'] : $data['facebook'] ?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['fbe']) ? $data['fbe'] : "" ?>
                </small>
            </div>
            <div class="form-group my-3">
                <input type="submit" value="Update" name="submit" class="btn btn-danger">
                <a href="index.php?controller=chefs&action=detail" class="btn btn-outline-secondary">Back</a>
            </div>
        </form>
    </div>
</div>