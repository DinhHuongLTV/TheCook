<div class="bg_container py-5">
    <div class="container-md">
        <div class="row">
            <div class="col-lg-8 col-md-6">
            </div>
            <div class="col-lg-4 col-md-6">
                <form action="" class="thecook_form p-4" method="post">
                    <?php if (!empty($this->__data['error'])): ?>
                        <strong class="mb-2 d-block" style="color: red"><?php echo $this->__data['error']; unset($this->__data['error'])?></strong>
                    <?php endif ?>
                    <div class="mb-4">
                        <input type="text" name="username" id="" class="form-control" placeholder="Email"
                               value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''?>">
                        <div class="form-text">Nhập email/tk của bạn đã đăng ký</div>
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password"
                               value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''?>">
                        <div class="form-text">Nhập mật khẩu đã đăng ký cho tài khoản này</div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Đăng nhập" class="form-submit form-control" name="submit">
                    </div>
                    <div class="form_method mb-4">
                        <a href="index.php?controller=login&action=forgot" class="method_item thecook_link">Quên mật khẩu?</a>
                        <a href="index.php?controller=login&action=sms" class="method_item thecook_link">Đăng nhập với SMS</a>
                    </div>
                    <div class="form_divider mt-5 mb-4"></div>
                    <div class="form_method">
                        <a href="" class="method_item btn btn-outline-dark form_btn">Facebook</a>
                        <a href="" class="method_item btn btn-outline-dark form_btn">Google</a>
                        <a href="" class="method_item btn btn-outline-dark form_btn">Apple</a>
                    </div>
                    <div class="form_navigater mt-3">
                        <span>BẠN MỚI BIẾT ĐẾN THE COOK?</span>
                        <a href="index.php?controller=login&action=signup" class="navigater_link thecook_link">Đăng ký</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>