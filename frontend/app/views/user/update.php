<div class="info_container">
    <div class="container py-5 bg-light">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group my-3">
                <label for="username">Username: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter username"
                       name="username" value="<?php echo isset($data['username']) ? $data['username'] : ''?>"
                       disabled>
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ue']) ? $data['ue'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="avatar">Avatar</label>
                <img src="../backend/assets/uploads/<?php echo $data['avatar']?>"
                     style="height: 50px; width: 50px; border-radius: 50px" alt="user - avatar">
                <input type="file" class="form-control-file" id="avatar" name="avatar">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ae']) ? $data['ae'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Password: </label>
                <input type="password" class="form-control" id="username" placeholder="Enter password"
                       name="password" value="<?php echo isset($data['password']) ? $data['password'] : ""?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['pe']) ? $data['pe'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">First name: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter first name"
                       name="firstname" value="<?php echo isset($data['firstname']) ? $data['firstname'] : ""?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['fe']) ? $data['fe'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Last name: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter last name"
                       name="lastname" value="<?php echo isset($data['lastname']) ? $data['lastname'] : ""?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['le']) ? $data['le'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Phone: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter phone number"
                       name="phone" value="<?php echo isset($data['phone']) ? $data['phone'] : ""?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['phe']) ? $data['phe'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Address: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter address" name="address"
                       value="<?php echo isset($data['address']) ? $data['address'] : ""?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ade']) ? $data['ade'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Email: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter email" name="email"
                       value="<?php echo isset($data['email']) ? $data['email'] : ""?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['ee']) ? $data['ee'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Jobs: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter jobs" name="jobs"
                       value="<?php echo isset($data['jobs']) ? $data['jobs'] : ""?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['je']) ? $data['je'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <label for="username">Facebook: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter user's facebook"
                       name="facebook" value="<?php echo isset($data['facebook']) ? $data['facebook'] : ""?>">
                <small class="form-text text-muted" style="color: red">
                    <?php echo !empty($data['fbe']) ? $data['fbe'] : ""?>
                </small>
            </div>
            <div class="form-group my-3">
                <input type="submit" value="Update" name="submit" class="btn btn-danger">
                <a href="index.php?controller=user&action=detail" class="btn btn-outline-secondary">Trang
                    chủ</a>
            </div>
        </form>
    </div>
</div>