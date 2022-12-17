<div class="container" style="max-width: 500px">
    <form method="post" action="">
        <h2>Đăng nhập</h2>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo isset($data['username']) ? $data['username'] : ''?>" id="username" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" value="<?php echo isset($data['password']) ? $data['password'] : ''?>" id="password" class="form-control"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Đăng nhập" class="btn btn-primary"/>
            <p>
                Chưa có tài khoản, <a href="index.php?controller=login&action=signup">Đăng ký</a> ngay
            </p>
        </div>
    </form>
</div>